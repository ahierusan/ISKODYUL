<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FacultyAvailabilityController;
use Illuminate\Support\Facades\Auth;
use App\Models\CollegeDepartment;
use App\Http\Controllers\AppointmentController;
use Illuminate\Http\Request;
use App\Models\Faculty;

// Login Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Unified Google Login and Callback
Route::get('/auth/redirect', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Logout
Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
});


// Other routes
Route::get('/', function () {
    return view('landing-page');
});

Route::get('/video-tutorial', function () {
    return view('video-tutorial');
});

// faculty

Route::get('/faculty-dashboard', function () {
    $faculty = App\Models\Faculty::where('user_id', auth()->user()->id)->first();
    $appointments = app(App\Http\Controllers\AppointmentController::class)->getFacultyAppointments($faculty);
    $availabilities = App\Models\FacultyAvailability::where('faculty_id', $faculty->id)->get();
    
    return view('faculty.dashboard')
        ->with('user', Auth::user())
        ->with('availabilities', $availabilities)
        ->with('appointments', $appointments);
})->middleware('auth');

Route::get('/faculty-setup', function () {
    $collegeDepartments = CollegeDepartment::all(); 
    return view('faculty.setup')
        ->with('user', Auth::user())
        ->with('collegeDepartments', $collegeDepartments);
})->middleware('auth');

Route::post('/faculty-setup', [FacultyController::class, 'store'])
    ->middleware('auth');

Route::get('/faculty-availability', [FacultyAvailabilityController::class, 'index'])
    ->name('faculty.availability')
    ->middleware('auth');
// Keep these routes as they are
Route::post('/faculty-availability', [FacultyAvailabilityController::class, 'store'])
    ->name('faculty.availability.store')
    ->middleware('auth');
Route::delete('/faculty-availability/{id}', [FacultyAvailabilityController::class, 'destroy'])
    ->name('faculty.availability.destroy')
    ->middleware('auth');


// student

Route::get('/student-dashboard', function () {
    return view('student.dashboard')->with('user', Auth::user());
})->middleware('auth');

Route::get('/appointment', function () {
    $collegeDepartments = CollegeDepartment::all();
    return view('student.appointment')
    ->with('user', Auth::user())
    ->with('collegeDepartments', $collegeDepartments);;
})->middleware('auth');

Route::get('/appointment/faculty-list/{departmentId}', [AppointmentController::class, 'getFacultyListAndDetails']);
Route::get('/appointment/faculty-availability/{faculty}', [AppointmentController::class, 'getFacultyAvailability']);

Route::get('/select-schedule', function () {
    return view('student.select-schedule')->with('user', Auth::user());
})->middleware('auth');

Route::get('/faculty/{faculty}/availabilities', [FacultyAvailabilityController::class, 'getAvailabilities']);
Route::get('/api/faculty/{faculty}/availabilities', [FacultyAvailabilityController::class, 'getAvailabilities']);

// Add this route for storing appointment schedule
Route::post('/appointment/schedule/store', [AppointmentController::class, 'storeScheduleInSession'])
    ->name('appointment.schedule.store')
    ->middleware('auth');

Route::post('/session/store-faculty', function (Request $request) {
    session(['selected_faculty_id' => $request->faculty_id]);
    return response()->json(['success' => true]);
})->middleware('auth');

Route::get('/information', [AppointmentController::class, 'getInformationForm'])
    ->middleware('auth');

Route::post('/store-information', function (Request $request) {
    // Validate all required fields
    $validated = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'student_number' => 'required',
        'program_year_section' => 'required',
        'college_department' => 'required',
        'status' => 'required',
        'appointment_category' => 'required',
        'additional_notes' => 'nullable'
    ]);

    // Merge new information with existing schedule data
    $appointment_data = session('appointment_schedule');
    $appointment_data['student_info'] = $validated;
    
    session(['appointment_schedule' => $appointment_data]);
    
    return redirect('/confirmation');
})->middleware('auth')->name('store.information');

Route::get('/confirmation', function () {
    $appointmentData = session('appointment_schedule');
    $faculty = Faculty::findOrFail($appointmentData['faculty_id']);
    
    return view('student.confirmation')
        ->with('user', Auth::user())
        ->with('faculty', $faculty);
})->middleware('auth');

Route::post('/appointment/store', [AppointmentController::class, 'storeAppointment'])
    ->name('appointment.store')
    ->middleware('auth');


// sysad

Route::get('/admin-dashboard', function () {
    return view('sysad.dashboard')->with('user', Auth::user());
})->middleware('auth');
