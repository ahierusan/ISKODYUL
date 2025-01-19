<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Models\FacultyAvailability;
use Carbon\Carbon;

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
        // Get appointment data from session
        $appointmentData = session('appointment_schedule');
        $studentInfo = $appointmentData['student_info'];
        
        // Create new appointment using faculty_id from session
        $appointment = Appointment::create([
            'faculty_id' => $appointmentData['faculty_id'],
            'student_id' => Auth::id(),
            'date' => $appointmentData['date'],
            'time' => $appointmentData['time'],
            'duration' => $appointmentData['duration'],
            'status' => $appointmentData['requires_approval'] ? 'pending' : 'approved',
            'appointment_category' => $studentInfo['appointment_category'],
            'additional_notes' => $studentInfo['additional_notes'] ?? null,
        ]);

        // Handle Google Calendar integration
        if ($appointment->status === 'approved') {
            $this->createGoogleCalendarEvent($appointment);
        }

        // Clear session data
        session()->forget('appointment_schedule');

        return redirect('/student-dashboard')->with('success', 'Appointment scheduled successfully!');
    }

    private function createGoogleCalendarEvent($appointment)
    {
        $faculty = $appointment->faculty;
        $student = $appointment->student;
        
        // Create event for faculty
        $facultyCalendar = new GoogleCalendarController();
        $facultyCalendar->createAppointmentEvent([
            'title' => "Appointment with {$student->first_name} {$student->last_name}",
            'start_time' => $appointment->date . 'T' . $appointment->time,
            'duration' => $appointment->duration,
            'description' => $appointment->additional_notes,
            'attendees' => [$student->email]
        ]);

        // Create event for student if appointment is approved
        if ($appointment->status === 'approved') {
            $studentCalendar = new GoogleCalendarController();
            $studentCalendar->createAppointmentEvent([
                'title' => "Appointment with {$faculty->first_name} {$faculty->last_name}",
                'start_time' => $appointment->date . 'T' . $appointment->time,
                'duration' => $appointment->duration,
                'description' => $appointment->additional_notes,
                'attendees' => [$faculty->email]
            ]);
        }
    }
}