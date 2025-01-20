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
    protected $user;

    public function __construct($user = null)
    {
        $this->user = $user ?? Auth::user();
        $this->client = new Google_Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        
        $this->client->setAccessToken($this->user->google_access_token);
        
        if ($this->client->isAccessTokenExpired()) {
            if ($this->user->google_refresh_token) {
                $this->client->fetchAccessTokenWithRefreshToken($this->user->google_refresh_token);
                $newAccessToken = $this->client->getAccessToken();
                $this->user->update([
                    'google_access_token' => $newAccessToken['access_token']
                ]);
            } else {
                throw new \Exception('Refresh token not available. User needs to re-authenticate.');
            }
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
                    ['method' => 'popup', 'minutes' => 30],
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
        // Convert times to Asia/Manila timezone for Google Calendar
        $startDateTime = new \DateTime($eventData['start_time'], new \DateTimeZone('Asia/Manila'));
        $endDateTime = new \DateTime($eventData['end_time'], new \DateTimeZone('Asia/Manila'));

        $event = new \Google_Service_Calendar_Event([
            'summary' => $eventData['title'],
            'description' => $eventData['description'],
            'start' => [
                'dateTime' => $startDateTime->format('c'), // RFC3339 format
                'timeZone' => 'Asia/Manila',
            ],
            'end' => [
                'dateTime' => $endDateTime->format('c'), // RFC3339 format
                'timeZone' => 'Asia/Manila',
            ],
            'attendees' => array_map(function($email) {
                return ['email' => $email];
            }, $eventData['attendees']),
            'location' => $eventData['location'],
            'reminders' => [
                'useDefault' => false,
                'overrides' => [
                    ['method' => 'popup', 'minutes' => 30],
                    ['method' => 'email', 'minutes' => 1440],
                    ['method' => 'email', 'minutes' => 120],
                ],
            ],
        ]);

        try {
            return $this->calendarService->events->insert('primary', $event, ['sendNotifications' => true]);
        } catch (\Exception $e) {
            \Log::error('Google Calendar Event Creation Failed: ' . $e->getMessage());
            throw new \Exception('Failed to create calendar event: ' . $e->getMessage());
        }
    }
}