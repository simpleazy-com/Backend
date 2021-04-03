<?php

namespace App\Http\Middleware;

use Closure;

use App\Admin;
use App\Group;

use Auth;

class IsAdmin
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
        //Logika kurang, 'admin' disini yang dimaksud owner bukan 'admin' group
        $group_id = $request->route('id'); 
        $isAdmin = Admin::where('group_id', $group_id)->where('user_id', Auth::user()->id)->first();
        if(!$isAdmin){
            return response()->json(['message' => 'Access Forbidden'], 403);
        }

        return $next($request);
    }
}
