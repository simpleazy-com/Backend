<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Admin;
use App\Member;
use App\Group;

use Auth;

class AdminController extends Controller
{
    //Berisi Bisnis Logic Buat Admin

    public function settingsView($id){
        $group = Group::find($id);
        $mode = ['invite only', 'opened', 'closed'];
        return view('pages.settings', compact('group','mode'));
    }

    public function settings(Request $request){
        $validated = Validator::make($request->all(), [
            'name' => 'string|required|max:50',
            'description' => 'string|required|max:100',
            'mode' => 'string'
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $getId = $request->route('id');

        $group = Group::find($getId);
        $group->name = $request->get('name');
        $group->description = $request->get('description');
        $group->mode = $request->get('mode');
        $group->save();

        return response()->json(compact('group'), 201);
    }

    public function userInPending($id){
        $data['pending'] = DB::table('members')
            ->select(['name','members.user_id', 'members.group_id'])
            ->join('users','members.user_id','users.id')
            ->where('status','pending')
            ->get();

        return view('pages.member', $data);
    }

    public function userChangeStatus(Request $request){
        $validated = Validator::make($request->all(), [
            'status' => 'string',
            'user_id' => 'required',
            'group_id' => 'required'
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $member = Member::where('user_id', $request->get('user_id'))
        ->where('group_id', $request->get('group_id'))
        ->first();
        $member->status = $request->get('status');
        $member->save();
        
        if($member->status == 'rejected'){
            Member::where('user_id', $request->get('user_id'))->delete();
        }

        return redirect('/group/'.$request->route('id').'/member');

    }

    public function adminship($id){
        $data['users'] = DB::table('members')
            ->select(['name','members.user_id','members.isAdmin'])
            ->join('users','members.user_id','users.id')
            ->where('status','accepted')
            ->where('isAdmin', true)
            ->where('group_id', $id)
            ->get();
            $data['group_id'] = $id;
        return view('pages.adminList', compact('data'));
    }

    public function addAdminshipView($group_id){
        $data['users'] = DB::table('members')
            ->select(['name','members.user_id'])
            ->join('users','members.user_id','users.id')
            ->where('group_id', $group_id)
            ->where('status','accepted')
            ->where('isAdmin', false)
            ->get();

        $data['roles'] = ['admin'];
        
        return view('pages.addAdminship', $data);
    }

    public function addAdminship(Request $request){
        $validated = Validator::make($request->all(), [
            'role' => 'string',
            'user_id' => 'required'
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $admin = new Admin();
        $admin->user_id = $request->get('user_id');
        $admin->group_id = $request->route('id');
        $admin->role = $request->get('role');
        $admin->save();

        $changeMemberStatus = Member::where('user_id', $admin->user_id)
        ->where('group_id', $admin->group_id)
        ->first();
        $changeMemberStatus->isAdmin = true;
        $changeMemberStatus->save();

        return 
        redirect('/group/'.$admin->group_id.'/adminship');
        // response()->json($admin, 201);

    }

    public function demoteAdminshipStatus($group_id, Request $request){
        $user_id = $request->get('user_id');

        $demoteAdmin = Admin::where('user_id', $user_id)
            ->where('group_id', $group_id)
            ->delete();
        $changeMemberStatus = Member::where('user_id', $user_id)
            ->where('group_id', $group_id)
            ->first();
        $changeMemberStatus->isAdmin = false;
        $changeMemberStatus->save();

        return 
        redirect('/group/'.$group_id.'/adminship');
        // response()->json($changeMemberStatus, 201);
    }

}
