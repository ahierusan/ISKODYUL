<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\FacultyAvailability;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleCalendarController;
use App\Models\Faculty;
use Carbon\Carbon;

class FacultyAvailabilityController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'duration' => 'required|in:30,60',  // Updated to limit duration to 30 or 60 minutes
        ]);

        $faculty = Faculty::where('user_id', auth()->user()->id)->first();
        
        // Convert times to Carbon instances for comparison
        $newStartTime = Carbon::createFromFormat('H:i', $validated['start_time']);
        $newEndTime = Carbon::createFromFormat('H:i', $validated['end_time']);

        // Get all existing availabilities for the same day
        $existingAvailabilities = FacultyAvailability::where('faculty_id', $faculty->id)
            ->where('day_of_week', $validated['day_of_week'])
            ->get();

        // Find overlapping availabilities
        $overlappingAvailabilities = $existingAvailabilities->filter(function ($existing) use ($newStartTime, $newEndTime) {
            $existingStart = Carbon::createFromFormat('H:i:s', $existing->start_time);
            $existingEnd = Carbon::createFromFormat('H:i:s', $existing->end_time);

            return (
                ($newStartTime >= $existingStart && $newStartTime < $existingEnd) ||
                ($newEndTime > $existingStart && $newEndTime <= $existingEnd) ||
                ($newStartTime <= $existingStart && $newEndTime >= $existingEnd)
            );
        });

        // Delete overlapping availabilities from Google Calendar and database
        foreach ($overlappingAvailabilities as $overlapping) {
            try {
                if ($overlapping->google_event_id) {
                    $googleCalendar = new GoogleCalendarController();
                    $googleCalendar->deleteEvent($overlapping->google_event_id);
                }
                $overlapping->delete();
            } catch (\Exception $e) {
                \Log::error('Failed to delete overlapping availability: ' . $e->getMessage());
            }
        }

        // Create new availability
        $availability = FacultyAvailability::create([
            'faculty_id' => $faculty->id,
            'day_of_week' => $validated['day_of_week'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        // Update the Google Calendar integration
        try {
            $googleCalendar = new GoogleCalendarController();
            $eventId = $googleCalendar->createEvent($availability);
            $availability->update(['google_event_id' => $eventId]);
            
            return redirect('/faculty-availability')
                ->with('success', 'Availability saved successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to create Google Calendar event: ' . $e->getMessage());
            return redirect('/faculty-availability')
                ->with('error', 'Availability saved but failed to sync with Google Calendar. Please try again.');
        }
    }

    public function destroy($id)
    {
        $availability = FacultyAvailability::findOrFail($id);
        
        try {
            if ($availability->google_event_id) {
                $googleCalendar = new GoogleCalendarController();
                $googleCalendar->deleteEvent($availability->google_event_id);
            }
            
            $availability->delete();
            return redirect('/faculty-availability')
                ->with('success', 'Availability deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to delete availability: ' . $e->getMessage());
            return redirect('/faculty-availability')
                ->with('error', 'Failed to delete availability. Please try again.');
        }
    }


    public function index()
    {
        $user = auth()->user();
        $faculty = Faculty::where('user_id', $user->id)->first();
        $availabilities = FacultyAvailability::where('faculty_id', $faculty->id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
        
        return view('faculty.availability', [
            'availabilities' => $availabilities,
            'user' => $user
        ]);
    }

    public function getAvailabilities(Faculty $faculty)
    {
        \Log::debug('Getting availabilities for faculty: ' . $faculty->id);
        
        $availabilities = FacultyAvailability::where('faculty_id', $faculty->id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        \Log::debug('Found availabilities: ' . $availabilities->toJson());

        // Get dates for the next 14 days starting tomorrow
        $dates = [];
        $tomorrow = Carbon::tomorrow();
        $twoWeeksLater = Carbon::tomorrow()->addDays(13); // 14 days including tomorrow

        for ($date = $tomorrow; $date <= $twoWeeksLater; $date->addDay()) {
            $dayOfWeek = $date->format('l'); // Get day name (Monday, Tuesday, etc.)
            
            // Find availability for this day of week
            $dayAvailability = $availabilities->first(function($availability) use ($dayOfWeek) {
                return $availability->day_of_week === $dayOfWeek;
            });

            if ($dayAvailability) {
                $dates[] = [
                    'date' => $date->format('Y-m-d'),
                    'start_time' => $dayAvailability->start_time,
                    'end_time' => $dayAvailability->end_time,
                    'day_of_week' => $dayOfWeek
                ];
            }
        }

        \Log::debug('Returning dates: ' . json_encode($dates));
        return response()->json(['availabilities' => $dates]);
    }
    
}