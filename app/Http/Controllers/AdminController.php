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
        $mode = ['invite mode', 'opened', 'closed'];
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

        return response()->json(compact('group'), 201);
    }

    public function userInPending($id){
        // $pending = Member::where('group_id', $id)->get();
        $data['users'] = DB::table('members')->select(['name','members.user_id'])->join('users','members.user_id','users.id')->where('status','pending')->get();

        return view('pages.changeStatus', $data);
    }

    public function userChangeStatus(Request $request){
        $validated = Validator::make($request->all(), [
            'status' => 'string',
            'user_id' => 'required'
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $member = Member::where('user_id', $request->get('user_id'))->first();
        $member->status = $request->get('status');
        $member->save();
        return redirect('/group/'.$request->route('id').'/pending');

    }

    public function adminship(){
        $data['users'] = DB::table('members')->select(['name','members.user_id','members.isAdmin'])->join('users','members.user_id','users.id')->where('status','accepted')->where('isAdmin', true)->get();
        return $data;
    }

    public function addAdminshipView(){
        // fetch member room
        // geleh ih panjang urg teu ngarti make eloquent
        // ke ganti
        $data['users'] = DB::table('members')->select(['name','members.user_id'])->join('users','members.user_id','users.id')->where('status','accepted')->where('isAdmin', false)->get();
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

        $changeMemberStatus = Member::where('user_id', $admin->user_id)->first();
        $changeMemberStatus->isAdmin = true;
        $changeMemberStatus->save();

        return response()->json($admin, 201);

    }

}
