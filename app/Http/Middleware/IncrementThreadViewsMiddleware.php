<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Jobs\IncrementThreadViewsJob;

class IncrementThreadViewsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        IncrementThreadViewsJob::dispatch($request->thread);
        
        return $next($request);
    }
}
