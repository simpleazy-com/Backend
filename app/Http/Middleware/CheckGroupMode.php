<?php

namespace App\Http\Middleware;

use App\Group;


use Closure;

class CheckGroupMode
{
    public function handle($request, Closure $next)
    {
        $code = $request->get('code');

        $group = Group::where('code', $code)->first();
        
        if($group->mode == 'invite only'){
            return response()->json(['This group is invite only'], 400);
        }

        if($group->mode == 'closed'){
            return response()->json(['This group is closed for everyone'], 400);
        }
        
        return $next($request);
    }
}
