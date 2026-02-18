<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'time',
        'location',
        'description',
        'is_public',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_public' => 'boolean',
    ];
}
