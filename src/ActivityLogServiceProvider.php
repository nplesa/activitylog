<?php

namespace Nplesa\\ActivityLog;

use Illuminate\\Support\\ServiceProvider;
use Nplesa\\ActivityLog\\Middleware\\LogRequestMiddleware;

class ActivityLogServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../config/activitylog.php' => config_path('activitylog.php'),
        ], 'config');

        $this->app['router']->pushMiddlewareToGroup('web', LogRequestMiddleware::class);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/activitylog.php', 'activitylog');
    }
}
