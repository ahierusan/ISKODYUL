<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'faculty_id',
        'student_id',
        'date',
        'time',
        'duration',
        'status',
        'appointment_category',
        'additional_notes',
        'google_event_id',
        'student_google_event_id'
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'user_id');
    }
}