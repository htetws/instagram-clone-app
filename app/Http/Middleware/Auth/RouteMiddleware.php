<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;

class RouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()) {
            if (url()->current() == route('login')) {
                return back();
            } elseif (url()->current() == route('register')) {
                return back();
            }

            return $next($request);
        }

        return $next($request);
    }
}
