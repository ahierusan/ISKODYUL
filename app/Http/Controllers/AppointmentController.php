<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Appointment;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\FacultyAvailability;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function getFacultyListAndDetails($departmentId)
    {
        $facultyList = Faculty::with(['user', 'collegeDepartment'])
            ->where('college_department_id', $departmentId)
            ->get();

        $faculties = $facultyList->map(function ($faculty) {
            return [
                'id' => $faculty->id,
                'first_name' => $faculty->first_name,
                'last_name' => $faculty->last_name,
                'department' => $faculty->department,
                'bldg_no' => $faculty->bldg_no,
                'college_name' => $faculty->collegeDepartment->college_name,
                'college_acronym' => $faculty->collegeDepartment->acronym,  
                'email' => $faculty->user->email,
            ];
        });

        return response()->json(['faculties' => $faculties]);
    }

    public function getFacultyAvailability(Faculty $faculty)
    {
        $availabilities = FacultyAvailability::where('faculty_id', $faculty->id)->get();
        return response()->json(['availabilities' => $availabilities]);
    }

    public function storeScheduleInSession(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|in:30,60',
        ]);

        // Get faculty ID from session storage
        $facultyId = session('selected_faculty_id');
        
        // Get the day of week for the requested date
        $appointmentDate = Carbon::parse($request->date);
        $dayOfWeek = $appointmentDate->format('l');
        $appointmentTime = Carbon::parse($request->time);
        
        // Get faculty availability for this day
        $facultyAvailability = FacultyAvailability::where('faculty_id', $facultyId)
            ->where('day_of_week', $dayOfWeek)
            ->first();
        
        // Check if time is outside faculty availability
        $isOutsideHours = true; // Default to true if no availability found
        
        if ($facultyAvailability) {
            $availStartTime = Carbon::createFromFormat('H:i:s', $facultyAvailability->start_time);
            $availEndTime = Carbon::createFromFormat('H:i:s', $facultyAvailability->end_time);
            
            // Check if appointment time is within faculty availability
            $isOutsideHours = $appointmentTime->format('H:i') < $availStartTime->format('H:i') 
                || $appointmentTime->format('H:i') >= $availEndTime->format('H:i');
        }

        // Store schedule data in session
        session([
            'appointment_schedule' => [
                'faculty_id' => $facultyId,
                'date' => $request->date,
                'time' => $request->time,
                'duration' => $request->duration,
                'requires_approval' => $isOutsideHours,
            ]
        ]);

        return redirect('/information');
    }

    public function storeAppointment(Request $request)
    {
        // 1. Start database transaction
        DB::beginTransaction();
        
        try {
            // 2. Get appointment data from session
            $appointmentData = session('appointment_schedule');
            $studentInfo = $appointmentData['student_info'];
            
            // 3. Create or update student record
            $student = Student::updateOrCreate(
                ['student_number' => $studentInfo['student_number']],
                [
                    'user_id' => Auth::id(),
                    'first_name' => $studentInfo['first_name'],
                    'last_name' => $studentInfo['last_name'],
                    'program_year_section' => $studentInfo['program_year_section'],
                    'college_department' => $studentInfo['college_department'],
                    'status' => $studentInfo['status']
                ]
            );

            // 4. Parse dates using Carbon (following faculty pattern)
            $appointmentDate = Carbon::parse($appointmentData['date']);
            $startTime = Carbon::createFromFormat('H:i', $appointmentData['time']);
            $endTime = $startTime->copy()->addMinutes((int)$appointmentData['duration']);

            // 5. Create appointment record
            $appointment = new Appointment([
                'faculty_id' => $appointmentData['faculty_id'],
                'student_id' => Auth::id(),
                'date' => $appointmentDate->format('Y-m-d'),
                'time' => $startTime->format('H:i:s'),
                'duration' => (int)$appointmentData['duration'],
                'status' => $appointmentData['requires_approval'] ? 'pending' : 'approved',
                'appointment_category' => $studentInfo['appointment_category'],
                'additional_notes' => $studentInfo['additional_notes'] ?? null,
            ]);

            $appointment->save();

            // 6. Handle Google Calendar for approved appointments
            if ($appointment->status === 'approved') {
                try {
                    $calendarResult = $this->createGoogleCalendarEvent($appointment);
                    if ($calendarResult) {
                        $appointment->update([
                            'google_event_id' => $calendarResult['faculty_event_id'],
                            'student_google_event_id' => $calendarResult['student_event_id']
                        ]);
                    }
                } catch (\Exception $e) {
                    \Log::error('Google Calendar Creation Failed: ' . $e->getMessage());
                    // Continue with appointment creation even if calendar fails
                }
            }

            // 7. Commit transaction and clear session
            DB::commit();
            session()->forget('appointment_schedule');

            // 8. Redirect with success message
            return redirect('/student-dashboard')
                ->with('success', 'Appointment ' . 
                    ($appointment->status === 'approved' ? 'scheduled' : 'submitted for approval') . 
                    ' successfully!');

        } catch (\Exception $e) {
            // 9. Handle any errors
            DB::rollback();
            \Log::error('Appointment Creation Failed: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to schedule appointment: ' . $e->getMessage());
        }
    }

    private function createGoogleCalendarEvent($appointment)
    {
        try {
            $faculty = Faculty::with(['user', 'collegeDepartment'])->findOrFail($appointment->faculty_id);
            $student = Student::with('user')->where('user_id', $appointment->student_id)->firstOrFail();

            // Create proper DateTime objects with timezone
            $appointmentDate = new \DateTime($appointment->date, new \DateTimeZone('Asia/Manila'));
            $appointmentTime = new \DateTime($appointment->time, new \DateTimeZone('Asia/Manila'));
            
            // Combine date and time properly
            $startDateTime = new \DateTime(
                $appointmentDate->format('Y-m-d') . ' ' . $appointmentTime->format('H:i:s'),
                new \DateTimeZone('Asia/Manila')
            );
            
            // Create end time by adding duration
            $endDateTime = clone $startDateTime;
            $endDateTime->add(new \DateInterval('PT' . (int)$appointment->duration . 'M'));

            // Log the times for debugging
            \Log::debug('Appointment times:', [
                'Original Date' => $appointment->date,
                'Original Time' => $appointment->time,
                'Start DateTime' => $startDateTime->format('c'),
                'End DateTime' => $endDateTime->format('c')
            ]);

            // Prepare faculty event data
            $facultyEventData = [
                'title' => "Student Consultation: {$student->first_name} {$student->last_name}",
                'start_time' => $startDateTime->format('c'),
                'end_time' => $endDateTime->format('c'),
                'description' => $this->formatEventDescription([
                    'Category' => $appointment->appointment_category,
                    'Student' => "{$student->first_name} {$student->last_name}",
                    'Program' => $student->program_year_section,
                    'Notes' => $appointment->additional_notes ?? 'None'
                ]),
                'attendees' => [$student->user->email],
                'location' => "{$faculty->department} - {$faculty->bldg_no}",
                'duration' => (int)$appointment->duration
            ];

            // Prepare student event data
            $studentEventData = [
                'title' => "Faculty Consultation: {$faculty->first_name} {$faculty->last_name}",
                'start_time' => $startDateTime->format('c'),
                'end_time' => $endDateTime->format('c'),
                'description' => $this->formatEventDescription([
                    'Category' => $appointment->appointment_category,
                    'Faculty' => "{$faculty->first_name} {$faculty->last_name}",
                    'Department' => $faculty->collegeDepartment->college_name,
                    'Notes' => $appointment->additional_notes ?? 'None'
                ]),
                'attendees' => [$faculty->user->email],
                'location' => "{$faculty->department} - {$faculty->bldg_no}",
                'duration' => (int)$appointment->duration
            ];

            // Create events in both calendars
            $facultyCalendar = new GoogleCalendarController($faculty->user);
            $studentCalendar = new GoogleCalendarController($student->user);

            $facultyEvent = $facultyCalendar->createAppointmentEvent($facultyEventData);
            $studentEvent = $studentCalendar->createAppointmentEvent($studentEventData);

            return [
                'faculty_event_id' => $facultyEvent->id,
                'student_event_id' => $studentEvent->id
            ];

        } catch (\Exception $e) {
            \Log::error('Google Calendar Event Creation Failed: ' . $e->getMessage());
            \Log::error('Exception trace: ' . $e->getTraceAsString());
            throw $e;
        }
    }

    private function formatEventDescription($fields)
    {
        return collect($fields)
            ->map(function ($value, $key) {
                return "$key: $value";
            })
            ->join("\n");
    }
}