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
use Illuminate\Support\Facades\Log;

trait PriorityAppointmentScheduling
{
    /**
     * Organize and prioritize pending appointments
     * 
     * @param Faculty $faculty
     * @return array
     */
    private function prioritizeAppointments(Faculty $faculty)
    {
        // Decode inquiry categories
        $inquiryPriorities = json_decode($faculty->inquiry_categories, true);

        // Fetch pending appointments
        $pendingAppointments = Appointment::where('faculty_id', $faculty->id)
            ->where('status', 'pending')
            ->with(['student'])
            ->get();

        // Sort pending appointments by priority
        $sortedAppointments = $pendingAppointments->sort(function($a, $b) use ($inquiryPriorities) {
            // Default to lowest priority if not set
            $aPriority = $inquiryPriorities[$a->appointment_category] ?? 3;
            $bPriority = $inquiryPriorities[$b->appointment_category] ?? 3;

            // Lower number means higher priority
            if ($aPriority == $bPriority) {
                // If priorities are the same, sort by earliest date
                return Carbon::parse($a->date)->compare(Carbon::parse($b->date));
            }

            return $aPriority <=> $bPriority;
        });

        // Get approved appointments to find potential scheduling conflicts
        $approvedAppointments = Appointment::where('faculty_id', $faculty->id)
            ->where('status', 'approved')
            ->where('date', '>=', now()->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        // Schedule pending appointments
        $scheduledPendingAppointments = $this->scheduleQueuedAppointments(
            $sortedAppointments, 
            $approvedAppointments
        );

        return $scheduledPendingAppointments;
    }

    /**
     * Schedule queued appointments around existing approved appointments
     * 
     * @param \Illuminate\Support\Collection $pendingAppointments
     * @param \Illuminate\Support\Collection $approvedAppointments
     * @return \Illuminate\Support\Collection
     */
    private function scheduleQueuedAppointments($pendingAppointments, $approvedAppointments)
    {
        $scheduledAppointments = collect();
        
        // If no approved appointments, schedule from start of day
        if ($approvedAppointments->isEmpty()) {
            foreach ($pendingAppointments as $index => $appointment) {
                // Assuming standard business hours start at 8:00 AM
                $startTime = Carbon::parse('08:00:00');
                $appointment->suggested_time = $startTime->format('H:i:s');
                $scheduledAppointments->push($appointment);
                
                // Add duration for next appointment
                $startTime->addMinutes($appointment->duration);
            }
            return $scheduledAppointments;
        }

        // Start with the last approved appointment's end time
        $lastApprovedAppointment = $approvedAppointments->last();
        $availableTime = Carbon::parse($lastApprovedAppointment->date . ' ' . $lastApprovedAppointment->time)
            ->addMinutes($lastApprovedAppointment->duration);

        foreach ($pendingAppointments as $appointment) {
            // Check for conflicts with existing approved appointments
            $proposed = $this->findNextAvailableSlot(
                $availableTime, 
                $appointment->duration, 
                $approvedAppointments
            );

            $appointment->suggested_time = $proposed['time']->format('H:i:s');
            $appointment->suggested_date = $proposed['date']->format('Y-m-d');
            $scheduledAppointments->push($appointment);

            // Update available time for next appointment
            $availableTime = $proposed['time']->addMinutes($appointment->duration);
        }

        return $scheduledAppointments;
    }

    /**
     * Find the next available time slot
     * 
     * @param Carbon $startTime
     * @param int $duration
     * @param \Illuminate\Support\Collection $approvedAppointments
     * @return array
     */
    private function findNextAvailableSlot($startTime, $duration, $approvedAppointments)
    {
        $proposedTime = $startTime->copy();
        $proposedDate = $proposedTime->copy()->startOfDay();

        while (true) {
            $isConflict = $approvedAppointments->first(function ($appointment) use ($proposedTime, $duration, $proposedDate) {
                $appointmentStart = Carbon::parse($appointment->date . ' ' . $appointment->time);
                $appointmentEnd = $appointmentStart->copy()->addMinutes($appointment->duration);
                $proposedEnd = $proposedTime->copy()->addMinutes($duration);

                // Check for overlap on the same date
                return $proposedDate->isSameDay($appointmentStart) && 
                       $proposedTime < $appointmentEnd && 
                       $proposedEnd > $appointmentStart;
            });

            if (!$isConflict) {
                return [
                    'time' => $proposedTime,
                    'date' => $proposedDate
                ];
            }

            // If conflict found, move to next time slot
            $proposedTime->addMinutes(30);  // Try next 30-minute slot
        }
    }

    /**
     * Modify getFacultyAppointments to include prioritization
     * 
     * @param Faculty $faculty
     * @return array
     */
    public function getFacultyAppointments(Faculty $faculty)
    {
        $appointments = parent::getFacultyAppointments($faculty);

        // Add prioritized pending appointments
        $prioritizedPendingAppointments = $this->prioritizeAppointments($faculty);
        
        $appointments['pending_prioritized'] = $prioritizedPendingAppointments;

        return $appointments;
    }
}

// In AppointmentController, use the trait
class AppointmentController extends Controller
{
    use PriorityAppointmentScheduling;

    // Existing methods...
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

        if (!$facultyId) {
        // If no faculty ID in session, redirect back with an error
        return redirect('/select-schedule')
            ->with('error', 'Please select a faculty member first');
        }
        
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

    public function getFacultyAppointments(Faculty $faculty)
    {

        \Log::info('Faculty ID: ' . $faculty->id);
        // Get approved appointments with proper student relationship
        $approvedAppointments = Appointment::with(['student.user'])
            ->where('faculty_id', $faculty->id)
            ->where('status', 'approved')
            ->where('date', '>=', Carbon::today()->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        // Get pending appointments with proper student relationship
        $pendingAppointments = Appointment::with(['student.user'])
            ->where('faculty_id', $faculty->id)
            ->where('status', 'pending')
            ->where('date', '>=', Carbon::today()->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        // Transform the data to include necessary student information
        $transformAppointments = function($appointments) {
            return $appointments->map(function($appointment) {
                return [
                    'id' => $appointment->id,
                    'date' => $appointment->date,
                    'time' => $appointment->time,
                    'duration' => $appointment->duration,
                    'status' => $appointment->status,
                    'appointment_category' => $appointment->appointment_category,
                    'student' => [
                        'id' => $appointment->student->id,
                        'user_id' => $appointment->student->user_id,
                        'first_name' => $appointment->student->first_name,
                        'last_name' => $appointment->student->last_name,
                        'college_department' => $appointment->student->college_department,
                        'program_year_section' => $appointment->student->program_year_section,
                    ]
                ];
            });
        };

        return [
            
            'approved' => $transformAppointments($approvedAppointments),
            'pending' => $transformAppointments($pendingAppointments)
        ];
    }

    

    public function approveAppointment(Request $request, Appointment $appointment)
    {
        try {
            $appointment->status = 'approved';
            $appointment->save();

            // Create Google Calendar event
            $calendarResult = $this->createGoogleCalendarEvent($appointment);
            if ($calendarResult) {
                $appointment->update([
                    'google_event_id' => $calendarResult['faculty_event_id'],
                    'student_google_event_id' => $calendarResult['student_event_id']
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteAppointment(Request $request, Appointment $appointment)
    {
        try {
            // Delete Google Calendar events if they exist
            if ($appointment->google_event_id) {
                $faculty = Faculty::find($appointment->faculty_id);
                $facultyCalendar = new GoogleCalendarController($faculty->user);
                $facultyCalendar->deleteEvent($appointment->google_event_id);
            }
            if ($appointment->student_google_event_id) {
                $student = Student::where('user_id', $appointment->student_id)->first();
                $studentCalendar = new GoogleCalendarController($student->user);
                $studentCalendar->deleteEvent($appointment->student_google_event_id);
            }

            $appointment->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getInformationForm()
    {
        $user = Auth::user();
        
        // Get the student's most recent information
        $student = Student::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->first();
        
        // Get appointment schedule from session
        $appointmentSchedule = session('appointment_schedule');
        
        // Retrieve faculty based on the stored faculty ID
        $facultyId = session('selected_faculty_id');
        $faculty = Faculty::findOrFail($facultyId);
        
        return view('student.information')
            ->with('student', $student)
            ->with('faculty', $faculty)
            ->with('appointmentSchedule', $appointmentSchedule);
    }

    public function rejectAppointment(Appointment $appointment)
    {
        try {
            // Update appointment status to rejected
            $appointment->update([
                'status' => 'rejected'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Appointment rejected successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reject appointment: ' . $e->getMessage()
            ], 500);
        }
    }

public function cancelAppointment(Appointment $appointment)
{
    try {
        DB::beginTransaction();
        
        // Check if the appointment exists and belongs to the current user
        if (!$appointment || $appointment->student_id !== auth()->user()->id) {
            throw new \Exception('Unauthorized or appointment not found');
        }
        
        // Allow cancellation for both approved and pending statuses
        if (!in_array($appointment->status, ['approved', 'pending'])) {
            throw new \Exception('This appointment cannot be cancelled');
        }
        
        // Only proceed with Google Calendar deletions for approved appointments
        if ($appointment->status === 'approved') {
            // Get the faculty and student users
            $faculty = Faculty::with('user')->find($appointment->faculty_id);
            $student = Student::with('user')->where('user_id', $appointment->student_id)->first();
            
            if (!$faculty || !$student) {
                throw new \Exception('Required user information not found');
            }
            
            // Delete faculty's calendar event if it exists
            if ($appointment->google_event_id) {
                try {
                    $facultyGoogleCalendar = new GoogleCalendarController($faculty->user);
                    $facultyGoogleCalendar->deleteEvent($appointment->google_event_id);
                } catch (\Exception $e) {
                    \Log::error('Failed to delete faculty calendar event: ' . $e->getMessage());
                }
            }
            
            // Delete student's calendar event if it exists
            if ($appointment->student_google_event_id) {
                try {
                    $studentGoogleCalendar = new GoogleCalendarController($student->user);
                    $studentGoogleCalendar->deleteEvent($appointment->student_google_event_id);
                } catch (\Exception $e) {
                    \Log::error('Failed to delete student calendar event: ' . $e->getMessage());
                }
            }
        }
        
        // Soft delete or update status to cancelled
        $appointment->update([
            'status' => 'cancelled',
            'google_event_id' => null,
            'student_google_event_id' => null
        ]);
        
        DB::commit();
        return response()->json([
            'success' => true,
            'message' => 'Appointment canceled successfully'
        ]);
    } catch (\Exception $e) {
        DB::rollback();
        \Log::error('Appointment cancellation failed: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

    public function getFacultyAvailabilities(Faculty $faculty)
    {
        $availabilities = FacultyAvailability::where('faculty_id', $faculty->id)->get();
        
        // Get approved appointments
        $approvedAppointments = Appointment::where('faculty_id', $faculty->id)
            ->where('status', 'approved')
            ->where('date', '>=', now()->format('Y-m-d'))
            ->get();

        $bookedSlots = [];
        foreach ($approvedAppointments as $appointment) {
            $startTime = Carbon::parse($appointment->time);
            $endTime = $startTime->copy()->addMinutes($appointment->duration);
            
            $bookedSlots[$appointment->date][] = [
                'start' => $appointment->time,
                'end' => $endTime->format('H:i:s'),
                'duration' => $appointment->duration
            ];
        }

        return response()->json([
            'availabilities' => $availabilities,
            'bookedSlots' => $bookedSlots
        ]);
    }

    public function getAvailableTimeSlots(Request $request, Faculty $faculty)
    {
        $date = $request->date;
        $dayOfWeek = Carbon::parse($date)->format('l');
        
        // Get faculty's availability for this day
        $availability = FacultyAvailability::where('faculty_id', $faculty->id)
            ->where('day_of_week', $dayOfWeek)
            ->first();

        if (!$availability) {
            return response()->json(['timeSlots' => []]);
        }

        // Get approved appointments for this date
        $appointments = Appointment::where('faculty_id', $faculty->id)
            ->where('date', $date)
            ->where('status', 'approved')
            ->get();

        $bookedSlots = [];
        foreach ($appointments as $appointment) {
            $startTime = Carbon::parse($appointment->time);
            $endTime = $startTime->copy()->addMinutes($appointment->duration);
            $bookedSlots[] = [
                'start' => $appointment->time,
                'start_formatted' => $startTime->format('H:i:s'),
                'end' => $endTime->format('H:i:s')
            ];
        }

        // Generate available time slots
        $availableSlots = [];
        $startTime = Carbon::parse($availability->start_time);
        $endTime = Carbon::parse($availability->end_time);

        while ($startTime < $endTime) {
            $slotEnd = $startTime->copy()->addMinutes(30);
            $isAvailable = true;

            foreach ($bookedSlots as $bookedSlot) {
                $bookedStart = Carbon::parse($bookedSlot['start']);
                $bookedEnd = Carbon::parse($bookedSlot['end']);

                if ($startTime < $bookedEnd && $slotEnd > $bookedStart) {
                    $isAvailable = false;
                    break;
                }
            }
            if ($isAvailable) {
                $availableSlots[] = $startTime->format('H:i');
            }

            $startTime->addMinutes(30);
        }

        return response()->json(['timeSlots' => $availableSlots, 'bookedSlots' => $bookedSlots]);
    }


    
}