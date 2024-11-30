<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacultyAvailability extends Model
{
    use HasFactory;

    protected $fillable = ['faculty_id', 'day_of_week', 'start_time', 'end_time'];
}
