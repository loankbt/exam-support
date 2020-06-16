<?php

namespace App\Http\Middleware;

use Closure;

// use Illuminate\Auth\Middleware\Authenticate as Middleware;

class TeacherOnly
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        $user = $request->session()->get('user');

        if ($user->shift_id) {
            return $next($request);
        }
        
        return redirect()->back();
    }
}
