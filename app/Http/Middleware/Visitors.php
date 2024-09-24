<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Illuminate\Session\Store;

class Visitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $session;

    public function __construct(Store $session)
    {
        // Let Laravel inject the session Store instance,
        // and assign it to our $session variable.
        $this->session = $session;
    }

    public function handle($request, Closure $next)
    {
        $this->clearExpiredSessions();
        return $next($request);
    }
    private function clearExpiredSessions()
    {
        if($this->session->exists('visited')){
            $time = time();
            // Let the views expire after one hour.
            $throttleTime = 3600;
            $timestamp = $this->session->get('visited');
            if(!($timestamp + $throttleTime) > $time){
               $this->session->forget('visited');
            }
        }



    }

}
