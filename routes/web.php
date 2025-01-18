<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FacultyAvailabilityController;
use Illuminate\Support\Facades\Auth;
use App\Models\CollegeDepartment;
use App\Http\Controllers\AppointmentController;

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
    return view('faculty.dashboard')->with('user', Auth::user());
})->middleware('auth');

Route::get('/faculty-setup', function () {
    $collegeDepartments = CollegeDepartment::all(); 
    return view('faculty.setup')
        ->with('user', Auth::user())
        ->with('collegeDepartments', $collegeDepartments);
})->middleware('auth');

Route::post('/faculty-setup', [FacultyController::class, 'store'])
    ->middleware('auth');

// Replace your current GET route with this
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

Route::get('/information', function () {
    return view('student.information')->with('user', Auth::user());
})->middleware('auth');

Route::get('/confirmation', function () {
    return view('student.confirmation')->with('user', Auth::user());
})->middleware('auth');


// sysad

Route::get('/admin-dashboard', function () {
    return view('sysad.dashboard')->with('user', Auth::user());
})->middleware('auth');

