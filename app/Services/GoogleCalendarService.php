<?php

namespace App\Services;

use Google_Client;
use Google_Service_Calendar;

class GoogleCalendarService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path(config('services.google.calendar_credentials_path')));
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
        $this->client->addScope(Google_Service_Calendar::CALENDAR);

        // Set the redirect URI
        $this->client->setRedirectUri(config('services.google.redirect'));
    }

    public function getCalendarService()
    {
        return new Google_Service_Calendar($this->client);
    }
}
