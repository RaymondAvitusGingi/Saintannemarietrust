<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function ($model) {
            static::logActivity($model, 'created');
        });

        static::updated(function ($model) {
            static::logActivity($model, 'updated');
        });

        static::deleted(function ($model) {
            static::logActivity($model, 'deleted');
        });
    }

    protected static function logActivity($model, $action)
    {
        if (!Auth::check()) {
            return;
        }

        $changes = null;
        if ($action === 'updated') {
            $changes = [
                'before' => array_intersect_key($model->getOriginal(), $model->getDirty()),
                'after' => $model->getDirty(),
            ];
            
            // Don't log if no meaningful changes
            if (empty($changes['after'])) {
                return;
            }
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'changes' => $changes,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
