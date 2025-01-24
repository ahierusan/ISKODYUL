<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\FacultyAvailability;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    public function dashboard()
    {
        $faculty = Faculty::where('user_id', auth()->user()->id)->first();
        
        // Get current appointments for the dashboard
        $currentAppointments = Appointment::where('faculty_id', $faculty->id)
            ->where('date', '>=', now())
            ->orderBy('date')
            ->limit(4)
            ->get();
        
        // Get ALL appointments for the modal
        $allAppointments = Appointment::where('faculty_id', $faculty->id)
            ->orderBy('date', 'desc')
            ->get();
        
        return view('faculty.dashboard', compact('faculty', 'currentAppointments', 'allAppointments'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'college_department_id' => 'required|exists:college_departments,id',
        'department' => 'required|string',
        'fb_link' => 'nullable|url',
        'bldg_no' => 'nullable|string',
    ]);

    $inquiry_categories = [
        'advising' => (int)$request->input('dropdown1', 0),
        'undergraduate_thesis' => (int)$request->input('dropdown2', 0),
        'grade_consultation' => (int)$request->input('dropdown3', 0),
    ];

    $faculty = Faculty::updateOrCreate(
        ['user_id' => Auth::id()],
        [
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'college_department_id' => $validatedData['college_department_id'],
            'department' => $validatedData['department'],
            'fb_link' => $validatedData['fb_link'],
            'bldg_no' => $validatedData['bldg_no'],
            'inquiry_categories' => json_encode($inquiry_categories)
        ]
    );

    return redirect('/faculty-dashboard')
        ->with('success', 'Faculty profile updated successfully');
}
}