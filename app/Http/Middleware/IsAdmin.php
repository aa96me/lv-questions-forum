<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Log;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next = null, $guard = null)
    {
        if (Auth::check() && Auth::user()->id = 1) {
            return $next($request);
        } else {
            return redirect('login');
        }
    }
}
