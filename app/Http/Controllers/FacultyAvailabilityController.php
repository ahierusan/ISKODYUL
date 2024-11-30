// faculty availability controller
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacultyAvailability;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleCalendarController;
use App\Models\Faculty;

class FacultyAvailabilityController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday', 
            'start_time' => 'required|date_format:H:i', 
            'end_time' => 'required|date_format:H:i|after:start_time', 
        ]);

         $faculty = Faculty::where('user_id', auth()->user()->id)->first();

        $existingAvailability = FacultyAvailability::where('faculty_id', $faculty->id)
            ->where('day_of_week', $validated['day_of_week'])
            ->first();

        if ($existingAvailability) {
            $existingAvailability->update([
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
            ]);
            $availability = $existingAvailability;
        } else {
            // If no existing availability, create a new entry
            $availability = FacultyAvailability::create([
                'faculty_id' => $faculty->id,
                'day_of_week' => $validated['day_of_week'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
            ]);
        }

        // Sync the availability with Google Calendar
        $googleCalendar = new GoogleCalendarController();
        $googleCalendar->createEvent($availability); 

        return redirect('/faculty-availability')->with('success', 'Availability saved successfully.');
    }
}
