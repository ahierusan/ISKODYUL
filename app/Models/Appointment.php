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
        'status'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}