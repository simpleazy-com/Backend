<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Group;
use App\Admin;
use App\Member;
use Auth;

class GroupController extends Controller
{
    public function groupList(){
        $data['owned'] = Admin::where('user_id', Auth::id())
        ->join('groups','admins.group_id','groups.id')
        ->where('role', 'owner')
        ->get();
        $data['joined'] = Member::where('user_id', Auth::id())->get();
        return 
        view('pages.group', compact('data'));
        // response()->json(compact('data'), 200);
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
        $verif = Admin::where('group_id', $id)
        ->join('groups','admins.group_id','groups.id')
        ->where('admins.user_id',Auth::user()->id)
        ->get();
        if(!sizeof($verif) == 0){
            $group = Group::find($verif[0]->id);
        }else{
            $group = "Access Probidden";
        }
        return 
        view('pages.detailGroup',compact('group'));
        // response()->json($group, 200);
    }

    public function joinView(){
        return view('pages.joinGroup');
    }

    public function join(Request $request){

        $code = $request->get('code');

        $group = Group::where('code', $code)->first();

        if(Member::where('user_id', Auth::user()->id)->first()){
            return response()->json(['Already Join'], 400);
        }

        if(Admin::where('user_id', Auth::user()->id)->first()){
            return response()->json(['Cannot join to your owned room'], 400);
        }  

        if(Member::where('user_id', Auth::user()->id)
            ->where('group_id', $group->id)
            ->whereIn('status', ['pending','accepted'])
            ->first()    
        ){
            return response()->json(['Already Join'], 400);
        }

        try{
            $member = new Member();
            $member->user_id = Auth::user()->id;
            $member->group_id = $group->id;
            $member->save();
        }catch(Exception $e){
            return response()->json($e->errors(), 400);
        }

        return response()->json(compact('group','member'), 201);

    }

    public function memberList($id){
        $memberList = DB::table('members')
            ->join('users', 'members.user_id', 'users.id')
            ->select('users.name', 'members.isAdmin')
            ->where('group_id', $id)
            ->where('status', 'accepted')
            ->get();
            return 
            view('pages.member',compact('memberList'));
            // response()->json($memberList, 200);
            
        // Raw queries debugger lol
        // return DB::table('members')->join('groups','members.group_id','groups.id')->get();
    }
}
