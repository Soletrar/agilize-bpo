<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->admin) {
            abort(401);
        }

        return $next($request);
    }
}
