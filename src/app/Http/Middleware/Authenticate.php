<?php

namespace App\Http\Middleware;

use Closure;

// use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return route('login');
    //     }
    // }
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('user')) {
            return $next($request);
        } else {
            return redirect()->route('index');
        }
    }
}
