<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            $model->logActivity('created', $model->getOriginal(), $model->getAttributes());
        });

        static::updated(function ($model) {
            $model->logActivity('updated', $model->getOriginal(), $model->getAttributes());
        });

        static::deleted(function ($model) {
            $model->logActivity('deleted', $model->getOriginal(), null);
        });
    }

    protected function logActivity($action, $oldValues = null, $newValues = null)
    {
        $excludeFields = ['password', 'remember_token', 'updated_at'];
        
        $oldValuesFiltered = $oldValues ? array_diff_key($oldValues, array_flip($excludeFields)) : null;
        $newValuesFiltered = $newValues ? array_diff_key($newValues, array_flip($excludeFields)) : null;
        
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => get_class($this),
            'model_id' => $this->id,
            'description' => $this->getActivityDescription($action),
            'old_values' => $oldValuesFiltered ? array_diff_assoc($oldValuesFiltered, $this->getAttributes()) : null,
            'new_values' => $newValuesFiltered ? array_diff_assoc($newValuesFiltered, $oldValuesFiltered ?? []) : null,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    protected function getActivityDescription($action)
    {
        $modelName = class_basename($this);
        $userName = auth()->user() ? auth()->user()->name : 'Гость';
        
        $identifier = $this->getIdentifier();
        
        return match($action) {
            'created' => "{$userName} создал {$modelName}: {$identifier}",
            'updated' => "{$userName} обновил {$modelName}: {$identifier}",
            'deleted' => "{$userName} удалил {$modelName}: {$identifier}",
            default => "{$userName} выполнил действие {$action} над {$modelName}: {$identifier}",
        };
    }

    protected function getIdentifier()
    {
        if (isset($this->title)) {
            return $this->title;
        }
        if (isset($this->name)) {
            return $this->name;
        }
        return "#{$this->id}";
    }
}