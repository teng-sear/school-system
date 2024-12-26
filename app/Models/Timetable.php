<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'subject_id',
        'day_id',
        'start_time',
        'end_time',
        'room_no'
    ];
}
