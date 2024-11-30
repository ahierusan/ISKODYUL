<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeDepartment extends Model
{
    protected $fillable = ['acronym', 'college_name'];

    public function faculties()
    {
        return $this->hasMany(Faculty::class); 
    }
}

