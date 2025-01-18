<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\User;
use App\Models\Appointment;
use App\Models\FacultyAvailability;
use App\Models\CollegeDepartment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function getFacultyListAndDetails($departmentId)
    {
        // Fetch the faculties with their associated department, user (email), and other details
        $facultyList = Faculty::with(['user', 'collegeDepartment'])
            ->where('college_department_id', $departmentId)
            ->get();

        // Prepare the data to include the necessary details (including email from User model)
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

    public function storeSchedule(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|in:30,60,90,120',
        ]);

        // Check if time is outside regular hours
        $hour = (int) substr($request->time, 0, 2);
        $isOutsideHours = $hour < 8 || $hour >= 17;

        // Create the appointment
        $appointment = new Appointment();
        $appointment->student_id = auth()->id(); // Assuming you're using authentication
        $appointment->faculty_id = session('selected_faculty_id'); // Assuming you stored this in session
        $appointment->appointment_date = $request->date;
        $appointment->appointment_time = $request->time;
        $appointment->duration = $request->duration;
        $appointment->requires_approval = $isOutsideHours;
        $appointment->status = $isOutsideHours ? 'pending_approval' : 'scheduled';
        $appointment->save();

        // Store the appointment ID in session for the next step
        session(['appointment_id' => $appointment->id]);

        return redirect()->route('student.information');
    }

}
