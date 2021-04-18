<?php

namespace App\Http\Middleware;

use Closure;

use App\Member;

use Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        $adminExist = Member::where('user_id', $request->get('user_id'))->where('group_id', $request->route('id'))->first();
        if($adminExist->isAdmin == true){
            return response()->json(['This user is already being an admin in your room'], 400);
        }

        return $next($request);
    }
}
