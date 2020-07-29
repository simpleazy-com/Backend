<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class IsLogin
{
    public function handle($request, Closure $next)
    {

        if(! Auth::user() ){
            return redirect('/login');            
        }

        return $next($request);
    }
}
