<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\User;
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

}
