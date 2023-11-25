<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{


//    public function handle($request, \Closure $next, ...$guards)
//    {
//        if (auth()->guard('coins')->check()) {
//            return $next($request);
//        }
//
//        abort(401);
//    }


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('coins.login.form');
    }
}
