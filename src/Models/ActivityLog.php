<?php

namespace nplesa\ActivityLog\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'action',
        'model',
        'model_id',
        'request_method',
        'request_url',
        'request_ip',
        'payload'
    ];

    protected $casts = ['payload' => 'array'];
}
