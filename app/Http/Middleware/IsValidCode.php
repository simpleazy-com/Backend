<?php

namespace App\Http\Middleware;

use Closure;

use App\Group;

class IsValidCode
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
        $code = $request->get('code');
        if(! Group::where('code', $code) ){
            return response()->json(['Invalid Code'], 400);
        }
        
        return $next($request);
    }
}
