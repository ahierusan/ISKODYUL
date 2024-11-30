<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\FacultyAvailability;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'college_department_id' => 'required|exists:college_departments,id',
            'department' => 'required|string|max:255',
            'fb_link' => 'nullable|url',
            'bldg_no' => 'required|string|max:255',
        ]);

        // Save to the Faculty table
        Faculty::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'college_department_id' => $request->college_department_id,
                'department' => $request->department,
                'fb_link' => $request->fb_link,
                'bldg_no' => $request->bldg_no,
            ]
        );


        $availabilityExists = FacultyAvailability::where('faculty_id', Auth::id())->exists();

        if ($availabilityExists) {
            return redirect('/faculty-dashboard')->with('success', 'Availability saved successfully.');
        } else {
            return redirect('/faculty-availability')->with('error', 'Please connect your Google Calendar.');
        }
    }
}
