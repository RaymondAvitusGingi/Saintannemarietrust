<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\Auditable;

class News extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'image',
        'category',
        'location',
        'author',
        'published_at',
        'is_published',
        'is_event',
        'event_date',
        'event_time',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'is_event' => 'boolean',
        'event_date' => 'date',
    ];

    /**
     * Auto-generate slug from title
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    /**
     * Scope for published news
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    /**
     * Get formatted date
     */
    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('F d, Y') : 'Draft';
    }
}
