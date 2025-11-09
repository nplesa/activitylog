<?php

namespace Nplesa\\ActivityLog\\Tests\\Feature;

use Illuminate\\Foundation\\Testing\\RefreshDatabase;
use Illuminate\\Support\\Facades\\Route;
use Illuminate\\Support\\Facades\\Schema;
use Nplesa\\ActivityLog\\Models\\ActivityLog;
use Orchestra\\Testbench\\TestCase;
use Nplesa\\ActivityLog\\ActivityLogServiceProvider;

class ActivityLogTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders(\$app)
    {
        return [ActivityLogServiceProvider::class];
    }

    protected function defineEnvironment(\$app)
    {
        \$app['config']->set('database.default', 'testing');
        \$app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /** @test */
    public function it_logs_http_requests()
    {
        Route::get('/hello', fn() => 'world');
        \$this->get('/hello')->assertSee('world');
        \$this->assertDatabaseHas('activity_logs', ['action' => 'request']);
    }
}
