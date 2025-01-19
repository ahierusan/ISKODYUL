<?php
namespace App\Http\Controllers;
use Google_Client;
use Google_Service_Calendar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GoogleCalendarController extends Controller
{
    protected $client;
    protected $calendarService;

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
            $user->update([
                'google_access_token' => $newAccessToken['access_token']
            ]);
        }

        $this->calendarService = new Google_Service_Calendar($this->client);
    }

    public function createEvent($availability)
    {
        $nextEventDate = $this->getNextEventDate($availability->day_of_week);
        $startDateTime = $nextEventDate . 'T' . $availability->start_time . ':00';
        $endDateTime = $nextEventDate . 'T' . $availability->end_time . ':00';

        $event = new \Google_Service_Calendar_Event([
            'summary' => 'Faculty Availability: ' . $availability->day_of_week,
            'description' => 'Available for consultations',
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
            'reminders' => [
                'useDefault' => false,
                'overrides' => [
                    ['method' => 'popup', 'minutes' => 10],
                ],
            ],
        ]);

        $createdEvent = $this->calendarService->events->insert('primary', $event);
        return $createdEvent->getId();
    }

    public function deleteEvent($eventId)
    {
        try {
            $this->calendarService->events->delete('primary', $eventId);
            return true;
        } catch (\Exception $e) {
            \Log::error('Failed to delete Google Calendar event: ' . $e->getMessage());
            throw $e;
        }
    }

    private function getNextEventDate($dayOfWeek)
    {
        $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        
        $currentDayIndex = Carbon::now()->dayOfWeek;
        $targetDayIndex = array_search($dayOfWeek, $daysOfWeek);
        
        $daysToAdd = ($targetDayIndex - $currentDayIndex + 7) % 7;
        
        return Carbon::now()->addDays($daysToAdd)->toDateString();
    }

    public function createAppointmentEvent($eventData)
    {
        $endTime = Carbon::parse($eventData['start_time'])
            ->addMinutes($eventData['duration']);

        $event = new \Google_Service_Calendar_Event([
            'summary' => $eventData['title'],
            'description' => $eventData['description'],
            'start' => [
                'dateTime' => $eventData['start_time'],
                'timeZone' => 'Asia/Manila',
            ],
            'end' => [
                'dateTime' => $endTime->format('Y-m-d\TH:i:s'),
                'timeZone' => 'Asia/Manila',
            ],
            'attendees' => array_map(function($email) {
                return ['email' => $email];
            }, $eventData['attendees']),
            'reminders' => [
                'useDefault' => false,
                'overrides' => [
                    ['method' => 'popup', 'minutes' => 10],
                    ['method' => 'email', 'minutes' => 60],
                ],
            ],
        ]);

        return $this->calendarService->events->insert('primary', $event);
    }
}