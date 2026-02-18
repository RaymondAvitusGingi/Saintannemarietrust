<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class GalleryImage extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'campus_id',
        'image_path',
        'caption',
        'order',
    ];

    /**
     * Get the full URL for the image
     */
    public function getImageUrlAttribute()
    {
        if (str_starts_with($this->image_path, 'http') || str_starts_with($this->image_path, '/images/')) {
            return $this->image_path;
        }
        
        return \Illuminate\Support\Facades\Storage::url($this->image_path);
    }

    /**
     * Scope to get images for a specific campus
     */
    public function scopeForCampus($query, $campusId)
    {
        return $query->where('campus_id', $campusId)->orderBy('order');
    }
}
