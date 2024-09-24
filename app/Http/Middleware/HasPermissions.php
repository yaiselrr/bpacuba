<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class HasPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $permission)
    {
        if(Auth::user()->can($permission))
            return $next($request);
        else
            abort(403);
    }
}
