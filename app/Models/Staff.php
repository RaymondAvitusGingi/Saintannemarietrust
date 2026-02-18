<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Staff extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'campus_id',
        'name',
        'title',
        'bio',
        'image',
        'category',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the campus the staff member belongs to.
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    /**
     * Get the full URL for the staff image
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return '/images/placeholder_avatar.jpg';
        }

        if (str_starts_with($this->image, 'http') || str_starts_with($this->image, '/images/')) {
            return $this->image;
        }
        
        return asset('storage/' . $this->image);
    }

    /**
     * Scope for active staff
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Scope for leadership staff
     */
    public function scopeLeadership($query)
    {
        return $query->where('category', 'leadership');
    }
}
