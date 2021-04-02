<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Group;
use App\Admin;
use App\Member;
use App\SetPayment;
use App\Log;
use Auth;

class GroupController extends Controller
{
    public function groupList(){
        $data['owned'] = Admin::where('user_id', Auth::user()->id)
        ->join('groups','admins.group_id','groups.id')
        ->where('role', 'owner')
        ->get();

        $data['joined'] = DB::table('members')
        ->join('groups', 'members.group_id', 'groups.id')
        ->where('members.user_id', Auth::user()->id)->get();
        
        return view('pages.group', compact('data'));
    }

    public function createView(){
        $mode = ['invite only', 'opened', 'closed'];
        return view('pages.createGroup', compact('mode'));
    }

    public function create(Request $request){
        $validated = Validator::make($request->all(), [
            'name' => 'string|required|max:50',
            'description' => 'string|required|max:100',
            'mode' => 'string'
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $group = new Group();
        $group->name = $request->get('name');
        $group->description = $request->get('description');
        $group->code = Str::random(8);
        $group->mode = $request->get('mode');
        $group->save();

        $owner = new Admin();
        $owner->user_id = Auth::user()->id;
        $owner->group_id = $group->id;
        $owner->role = 'owner';
        $owner->save();

        return response()->json(compact('group','owner'), 201);
        
    }

    public function groupDetail($id){
        $isAdmin;
        $verif = Admin::where('group_id', $id)
        ->join('groups','admins.group_id','groups.id')
        ->where('admins.user_id',Auth::user()->id)
        ->get();

        $verifMember = Member::where('group_id', $id)
        ->join('groups','members.group_id','groups.id')
        ->where('members.user_id',Auth::user()->id)
        ->get();

        try{
            if(!sizeof($verif) == 0){
                $data['group'] = Group::find($verif[0]->id);
                $isAdmin = true;
            }
            else if(!sizeof($verifMember) == 0){
                $data['group'] = Group::find($verifMember[0]->id);
                $isAdmin = false;
            }else{
                $data['group'] = "Access Probidden";
                $isAdmin = false;
            }
        }catch(ErrorException $e){
            echo $e;
        }

        $data['payment'] = SetPayment::where('group_id', $id)
        ->orderBy('deadline')
        ->get();

        return view('pages.detailGroup',compact('data'));
    }

    public function joinView(){
        return view('pages.joinGroup');
    }

    public function join(Request $request){

        $code = $request->get('code');
        $group = Group::where('code', $code)->first();

        $isJoined = Member::where('user_id', Auth::user()->id)->where('group_id', $group->id)->first();

        if($isJoined){
            return response()->json(['Already Joined'], 400);
        }

        try{
            $member = new Member();
            $member->status = 'accepted';
            $member->user_id = Auth::user()->id;
            $member->group_id = $group->id;
            $member->save();
        }catch(Exception $e){
            return response()->json($e->errors(), 400);
        }

        return response()->json(compact('group','member'), 201);

    }

    public function memberList($id){
        $data['memberList'] = DB::table('members')
            ->join('users', 'members.user_id', 'users.id')
            ->select('users.id','users.name', 'members.isAdmin')
            ->where('group_id', $id)
            ->where('status', 'accepted')
            ->get();

        $data['pending'] = DB::table('members')
            ->select(['name','members.user_id', 'members.group_id'])
            ->join('users','members.user_id','users.id')
            ->where('status','pending')
            ->get();

        return view('pages.member', $data);
    }

}
