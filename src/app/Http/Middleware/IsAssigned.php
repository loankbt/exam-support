<?php

namespace App\Http\Middleware;

use App\Test;
use Closure;
use Illuminate\Http\Request;

// use Illuminate\Auth\Middleware\Authenticate as Middleware;

class IsAssigned
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
        $path = $request->path();
        $test_id = substr($path, 10);

        $test = Test::find($test_id);
        $subject = $test->shift->subject;
        
        if ($user->shift_id == $subject->id) {
            return $next($request);
        }

        return redirect()->back();
    }
}
