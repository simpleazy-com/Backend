<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Validator;

use App\Group;
use App\Member;
use App\Admin;

use Auth;

use Closure;

class CheckGroupMode
{
    public function handle($request, Closure $next)
    {

        $validated = Validator::make($request->all(), [
            'code' => 'required'
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $code = $request->get('code');

        $group = Group::where('code', $code)->first();
        
        if($group == null){
            return response()->json(['Invalid room code'], 400);
        }
        
        if(Admin::where('user_id', Auth::user()->id)->where('group_id', $group->id)->where('role', 'owner')->orWhere('role','admin')->first()){
           return response()->json(['Redirecting to your room'], 400); 
        }
        
        
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
