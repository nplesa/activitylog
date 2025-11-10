<?php

namespace nplesa\ActivityLog\Middleware;

use Closure;
use Illuminate\Http\Request;
use nplesa\ActivityLog\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (!str_starts_with($request->path(), '_debugbar') && !str_starts_with($request->path(), 'telescope')) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'request',
                'request_method' => $request->method(),
                'request_url' => $request->fullUrl(),
                'request_ip' => $request->ip(),
                'payload' => json_encode($request->except(['password', '_token'])),
            ]);
        }

        return $response;
    }
}
