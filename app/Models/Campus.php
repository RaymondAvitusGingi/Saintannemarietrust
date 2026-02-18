<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Campus extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'slug',
        'name',
        'email',
        'level',
        'motto',
        'description',
        'image',
        'logo',
        'ranking',
        'location',
        'address',
        'acreage',
        'registration',
        'phone',
        'mission',
        'vision',
        'headmaster',
        'combinations',
        'history',
        'environment',
        'rules',
        'routine',
        'instagram',
        'order',
    ];

    protected $casts = [
        'rules' => 'array',
        'routine' => 'array',
    ];

    /**
     * Get all staff members for this campus.
     */
    public function staff()
    {
        return $this->hasMany(Staff::class)->orderBy('order');
    }

    /**
     * Get active staff members only.
     */
    public function activeStaff()
    {
        return $this->hasMany(Staff::class)->where('is_active', true)->orderBy('order');
    }
}
