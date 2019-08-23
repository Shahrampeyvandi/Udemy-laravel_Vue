<?php

namespace Bahdcasts\Http\Middleware;

use Bahdcasts\User;
use Closure;

class Administrator
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
        // 2- create a custon config file and check value with isAdmin() method

        if(auth()->check()) {
            if(auth()->user()->isAdmin()) {
                return $next($request);
            } else {
                session()->flash('error', 'You are not authorized to perform this action');
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
        
    }
}
