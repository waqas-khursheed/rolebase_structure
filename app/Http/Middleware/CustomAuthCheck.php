<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CustomAuthCheck
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
        if(!Session::has('loginId')){
            return redirect('custom/login')->with('fail', 'You have to login first');
        }
        return $next($request);
    }
}
