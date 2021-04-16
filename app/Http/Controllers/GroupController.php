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

        $data['owned'] = Admin::where('user_id', Auth::id())
        ->join('users', 'admins.user_id', 'users.id')
        ->join('groups','admins.group_id','groups.id')
        ->selectRaw('users.name as user_name, groups.id as group_id, groups.*, admins.*')
        ->where('role', 'owner')
        ->get();

        // $data['joined'] = Member::where('members.user_id', Auth::id())
        // ->join('users', 'members.user_id','users.id')
        // ->join('admins', 'users.id', 'admins.user_id')
        // ->where('admins.role', 'owner')
        // ->join('groups','members.group_id','groups.id')
        // ->get();

        $data['joined'] = Admin::join('users','admins.user_id','users.id')
        ->join('groups', 'admins.group_id', 'groups.id')
        ->join('members','groups.id','members.group_id')
        ->where('members.user_id', Auth::id())
        ->where('members.status', 'accepted')
        ->selectRaw('*, users.name as owner_name')
        ->where('admins.role','owner')
        ->get();

        return 
        view('pages.group', compact('data'));
        // response()->json(compact('data'), 200);
        // json_decode($data['joined']);
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

        return 
        redirect('/group');
        // response()->json(compact('group','owner'), 201);
        
    }

    public function groupDetail($id){
        $role;
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
                $role = 1;
                if($verif[0] -> role == "owner"){
                    $role = 2;
                }
            }
            else if(!sizeof($verifMember) == 0){
                $data['group'] = Group::find($verifMember[0]->id);
                $role = 0;
            }else{
                $data['group'] = "Access Probidden";
                $role = 0;
            }
        }catch(ErrorException $e){
            echo $e;
        }
        $data['role'] = $role;
        $data['payment'] = SetPayment::where('group_id', $id)->get();

        return view('pages.detailGroup',compact('data'));
    }

    public function joinView(){
        return view('pages.joinGroup');
    }

    public function join(Request $request){

        $code = $request->get('code');
        $group = Group::where('code', $code)->first();

        if(Member::where('user_id', Auth::user()->id)->where('group_id', $group->id)->first()){
            return 
            redirect('/group');
            // response()->json(['Already Joined'], 400);
        }

        try{
            $member = new Member();
            $member->status = 'accepted';
            $member->user_id = Auth::user()->id;
            $member->group_id = $group->id;
            $member->save();
        }catch(Exception $e){
            return 
            redirect('/group');
            // response()->json($e->errors(), 400);
        }

        return 
        redirect('/group');
        // response()->json(compact('group','member'), 201);

    }

    public function memberList($id){
        $data['role'] = sizeof(Admin::where('user_id', Auth::user()->id)
        ->where('group_id', $id)
        ->get());

        $data['memberList'] = DB::table('members')
            ->join('users', 'members.user_id', 'users.id')
            ->select('users.id','users.name', 'members.isAdmin')
            ->where('group_id', $id)
            ->where('status', 'accepted')
            ->orderBy('isAdmin','desc')
            ->get();

        $data['pending'] = DB::table('members')
            ->select(['name','members.user_id', 'members.group_id'])
            ->join('users','members.user_id','users.id')
            ->where('group_id', $id)
            ->where('status','pending')
            ->get();

        return 
        // response()->json(compact('role'));
        view('pages.member', $data);
    }

    public function infoView($id){

        // query memanggil data member/admin
        $data['member'] = Member::where('members.group_id', $id)
        ->where('members.user_id', Auth::id())->get();
        $data['admin'] = Admin::where('admins.group_id', $id)
        ->where('admins.user_id', Auth::id())->get();
        $data['group'] = array();
        // validasi apakah member atau admin
        try{
            if(sizeof($data['member']) != 0 || sizeof($data['admin']) != 0 ){
                $data['group'] = Group::where('groups.id', $id)->get();
            }else{
                $data['group'] = array();
            }
        }catch(ErrorException $e){
            $data['group'] = array();
        }

        // query memanggil data owner dari group
        $data['owner'] = Admin::where('admins.group_id', $id)
        ->join('users','admins.user_id','users.id')
        ->selectRaw('name')
        ->get();

        // validasi apakah data group kosong atau tidak
        try{
            if(sizeof($data['group']) != 0){
                return view('pages.info', compact('data'));
            }else{
                return redirect('/group');
            }
        }catch(ErrorException $e){
            return redirect('/group');
        }
        // return response()->json($data, 200);
    }
}
