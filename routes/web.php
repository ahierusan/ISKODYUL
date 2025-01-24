<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FacultyAvailabilityController;
use Illuminate\Support\Facades\Auth;
use App\Models\CollegeDepartment;
use App\Http\Controllers\AppointmentController;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Appointment;

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

// Dashboard Routing
Route::get('/dashboard', function () {
    return match(auth()->user()->role) {
        'student' => redirect('/student-dashboard'),
        'faculty' => redirect('/faculty-dashboard'),
        'admin' => redirect('/admin-dashboard'),
        default => redirect('/')
    };
})->middleware('auth');

// Student and Admin Routes
Route::middleware(['auth', 'role:admin,student'])->group(function () {
    // Student Dashboard
    Route::get('/student-dashboard', function () {
        $user = Auth::user();
        $appointments = Appointment::where('student_id', $user->id)
            ->where('status', 'approved')
            ->with(['faculty', 'faculty.collegeDepartment'])
            ->orderBy('date', 'asc')
            ->get();

        $pendingAppointments = Appointment::where('student_id', $user->id)
            ->where('status', 'pending')
            ->with(['faculty', 'faculty.collegeDepartment'])
            ->orderBy('date', 'asc')
            ->get();

        return view('student.dashboard')
            ->with('user', $user)
            ->with('appointments', $appointments)
            ->with('pendingAppointments', $pendingAppointments);
    });

    Route::get('/appointment', function () {
        $collegeDepartments = CollegeDepartment::all();
        return view('student.appointment')
        ->with('user', Auth::user())
        ->with('collegeDepartments', $collegeDepartments);
    });

    Route::get('/appointment/faculty-list/{departmentId}', [AppointmentController::class, 'getFacultyListAndDetails']);
    Route::get('/appointment/faculty-availability/{faculty}', [AppointmentController::class, 'getFacultyAvailability']);

    Route::get('/select-schedule', function () {
        return view('student.select-schedule')->with('user', Auth::user());
    });

    Route::get('/faculty/{faculty}/availabilities', [FacultyAvailabilityController::class, 'getAvailabilities']);
    Route::get('/api/faculty/{faculty}/availabilities', [FacultyAvailabilityController::class, 'getAvailabilities']);

    Route::post('/appointment/schedule/store', [AppointmentController::class, 'storeScheduleInSession'])
        ->name('appointment.schedule.store');

    Route::post('/session/store-faculty', function (Request $request) {
        session(['selected_faculty_id' => $request->faculty_id]);
        return response()->json(['success' => true]);
    });

    Route::get('/information', [AppointmentController::class, 'getInformationForm']);

    Route::post('/store-information', function (Request $request) {
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

        $appointment_data = session('appointment_schedule');
        $appointment_data['student_info'] = $validated;
        
        session(['appointment_schedule' => $appointment_data]);
        
        return redirect('/confirmation');
    })->name('store.information');

    Route::get('/confirmation', function () {
        $appointmentData = session('appointment_schedule');
        $faculty = Faculty::findOrFail($appointmentData['faculty_id']);
        
        return view('student.confirmation')
            ->with('user', Auth::user())
            ->with('faculty', $faculty);
    });

    Route::post('/appointment/store', [AppointmentController::class, 'storeAppointment'])
        ->name('appointment.store');
});

// Faculty and Admin Routes
Route::middleware(['auth', 'role:admin,faculty'])->group(function () {
    // Faculty Dashboard
    Route::get('/faculty-dashboard', function () {
    $faculty = App\Models\Faculty::where('user_id', auth()->user()->id)->first();
    
    // Add a null check
    if (!$faculty) {
        // Redirect to faculty setup or show an error
        return redirect('/faculty-setup')->with('error', 'Please complete your faculty profile');
    }

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
    });

    Route::post('/faculty-setup', [FacultyController::class, 'store']);

    Route::get('/faculty-availability', [FacultyAvailabilityController::class, 'index'])
        ->name('faculty.availability');

    Route::post('/faculty-availability', [FacultyAvailabilityController::class, 'store'])
        ->name('faculty.availability.store');

    Route::delete('/faculty-availability/{id}', [FacultyAvailabilityController::class, 'destroy'])
        ->name('faculty.availability.destroy');

    Route::post('/appointment/{appointment}/approve', [AppointmentController::class, 'approveAppointment'])
        ->name('appointment.approve');

    Route::post('/appointment/{appointment}/reject', [AppointmentController::class, 'rejectAppointment'])
        ->name('appointment.reject');

    Route::post('/appointment/{appointment}/cancel', [AppointmentController::class, 'cancelAppointment'])
        ->name('appointment.cancel');

    Route::get('/appointment/available-slots/{faculty}', [AppointmentController::class, 'getAvailableTimeSlots'])
        ->name('appointment.available-slots');
});

// Admin-only Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard', function () {
        return view('sysad.dashboard')->with('user', Auth::user());
    });

    // Additional admin-specific routes can be added here
    // For example:
    // Route::get('/manage-users', [AdminController::class, 'manageUsers']);
    // Route::get('/view-all-appointments', [AdminController::class, 'viewAppointments']);
});