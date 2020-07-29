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
        $owner = Admin::where('user_id', Auth::user()->id)->first();
        
        if(! $owner->role == 'owner' ){
            return response()->json(['message' => 'Access Forbidden'], 403);
        }

        return $next($request);
    }
}
