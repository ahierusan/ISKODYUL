<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'college_department_id',
        'department',
        'fb_link',
        'bldg_no',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function collegeDepartment()
    {
        return $this->belongsTo(CollegeDepartment::class);
    }
}
