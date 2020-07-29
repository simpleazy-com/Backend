<?php

namespace App\Http\Middleware;

use Closure;

use App\Admin;
use App\Group;

use Auth;

class IsOwner
{
    public function handle($request, Closure $next)
    {
        $group_id = $request->route('id'); 
        if(! Admin::where('group_id', $group_id)->where('user_id', Auth::user()->id)->first()){
            return response()->json(['Access Forbidden'], 403);
        }

        return $next($request);
    }
}
