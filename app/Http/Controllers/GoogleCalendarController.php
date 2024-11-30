// google calendar controller
<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Calendar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GoogleCalendarController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        
        $user = Auth::user();
        $this->client->setAccessToken($user->google_access_token);

        if ($this->client->isAccessTokenExpired()) {
            $this->client->fetchAccessTokenWithRefreshToken($user->google_refresh_token);
            $newAccessToken = $this->client->getAccessToken();

            // Update the tokens in the database
            $user->update(['google_access_token' => $newAccessToken['access_token']]);
        }
    }

    public function createEvent($availability)
    {
        $calendarService = new Google_Service_Calendar($this->client);

        $nextEventDate = $this->getNextEventDate($availability->day_of_week);

        $startDateTime = $nextEventDate . 'T' . $availability->start_time . ':00';
        $endDateTime = $nextEventDate . 'T' . $availability->end_time . ':00';

        $event = new \Google_Service_Calendar_Event([
            'summary' => 'Faculty Availability: ' . $availability->day_of_week,
            'start' => [
                'dateTime' => $startDateTime,
                'timeZone' => 'Asia/Manila',
            ],
            'end' => [
                'dateTime' => $endDateTime,
                'timeZone' => 'Asia/Manila',
            ],
            'recurrence' => [
                'RRULE:FREQ=WEEKLY;BYDAY=' . strtoupper(substr($availability->day_of_week, 0, 2)),
            ],
        ]);

        $calendarService->events->insert('primary', $event);
    }

    private function getNextEventDate($dayOfWeek)
    {
        $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        
        $currentDayIndex = Carbon::now()->dayOfWeek;
        $targetDayIndex = array_search($dayOfWeek, $daysOfWeek);
        
        $daysToAdd = ($targetDayIndex - $currentDayIndex + 7) % 7;
        
        return Carbon::now()->addDays($daysToAdd)->toDateString();
    }
}
