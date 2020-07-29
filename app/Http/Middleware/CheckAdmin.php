<?php

namespace App\Http\Middleware;

use Closure;

use App\Admin;

use Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        $adminExist = Admin::where('user_id', Auth::user()->id)->first();

        if($adminExist){
            return response()->json(['This user is already being an admin in your room'], 400);
        }

        return $next($request);
    }
}
