<?php

namespace nplesa\ActivityLog\Traits;

use nplesa\ActivityLog\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        foreach (['created', 'updated', 'deleted', 'restored'] as $event) {
            static::\$event(function (\$model) use (\$event) {
                ActivityLog::create([
                    'user_id' => Auth::id(),
                    'action' => \$event,
                    'model' => get_class(\$model),
                    'model_id' => \$model->getKey(),
                    'payload' => json_encode(\$model->getChanges()),
                ]);
            });
        }
    }
}
