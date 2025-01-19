<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

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

        // Check if time is outside regular hours
        $hour = (int) substr($request->time, 0, 2);
        $isOutsideHours = $hour < 8 || $hour >= 17;

        // Store schedule data in session
        session([
            'appointment_schedule' => [
                'date' => $request->date,
                'time' => $request->time,
                'duration' => $request->duration,
                'requires_approval' => $isOutsideHours,
            ]
        ]);

        return redirect('/information');
    }
}