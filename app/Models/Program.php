<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    public function faculty () {
        return $this->belongsTo(Faculty::class);
    }

    public function students ()
    {
        return $this->hasMany(Student::class);
    }

    public function courses ()
    {
        return $this->hasMany(Course::class);
    }
}
