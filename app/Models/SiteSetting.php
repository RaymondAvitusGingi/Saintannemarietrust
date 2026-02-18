<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class SiteSetting extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'key',
        'value',
        'category',
        'label',
        'type',
    ];

    /**
     * static helper to get a setting value
     */
    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
}
