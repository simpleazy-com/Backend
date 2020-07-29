<?php

namespace App\Http\Middleware;

use App\Group;
use App\Member;

use Auth;

use Closure;

class CheckGroupMode
{
    public function handle($request, Closure $next)
    {
        $code = $request->get('code');

        $group = Group::where('code', $code)->first();
        
        
        if($group->mode == 'invite only'){

            if(Member::where('user_id', Auth::user()->id)->where('status','pending')->first()){
                return response()->json(['message' => 'Wait admin to response your request'], 400);
            }
            
            try{
                $member = new Member();
                $member->user_id = Auth::user()->id;
                $member->group_id = $group->id;
                $member->status = 'pending';
                $member->save();
            }catch(Exception $e){
                echo $e;
            }
            
            return response()->json(['message' => 'Waiting for the admin to approve the request'], 201);
        }

        if($group->mode == 'closed'){
            return response()->json(['This group is closed for everyone'], 400);
        }
        
        return $next($request);
    }
}
