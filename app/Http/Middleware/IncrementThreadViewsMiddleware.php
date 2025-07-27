<?php

namespace App\Http\Middleware;

use App\Jobs\IncrementThreadViewsJob;
use Closure;
use Illuminate\Http\Request;

class IncrementThreadViewsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        IncrementThreadViewsJob::dispatch($request->thread);

        return $next($request);
    }
}
