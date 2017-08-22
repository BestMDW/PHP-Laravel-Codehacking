<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if user is logged in.
        if (Auth::check()) {
            // Check if user has admin permission.
            if (Auth::user()->isAdmin()) {
                return $next($request);
            }
        }

        return redirect(404);
    }
}
