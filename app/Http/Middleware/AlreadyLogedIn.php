<?php

namespace App\Http\Middleware;

use Closure;

class AlreadyLogedIn
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
        if(Session()->has('loginId') && (url('custom/login') == $request->url() || (url('custom/registration') == $request->url()))){
            return back();
        }
        return $next($request);
    }
}
