<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use App\Group;
use App\Admin;
use App\Member;
use Auth;

class GroupController extends Controller
{
    public function groupList(){
        // Didieu bisa make raw query atau eloquent serah
        $adminTable = Admin::where('user_id', Auth::user()->id)->get();
        // $groupTable = Group::where
        return response()->json($adminTable, 200);
    }

    public function createView(){
        return view('pages.createGroup');
    }

    public function create(Request $request){
        $validated = Validator::make($request->all(), [
            'name' => 'string|required|max:50',
            'description' => 'string|required|max:100'
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $group = new Group();
        $group->name = $request->get('name');
        $group->description = $request->get('description');
        $group->code = Str::random(8);
        $group->save();

        $admin = new Admin();
        $admin->user_id = Auth::user()->id;
        $admin->group_id = $group->id;
        $admin->role = 'admin';
        $admin->save();

        return response()->json(compact('group','admin'), 201);
        
    }

    public function groupDetail($id){
        $group = Group::find($id);

        return response()->json($group, 200);
    }

    public function joinView(){
        return view('pages.joinGroup');
    }

    public function join(Request $request){
        $code = $request->get('code');

        $group = Group::where('code', $code)->first();

        if(Member::where('user_id', Auth::user()->id)->first()){
            return reponse()->json(['Already Join'], 400);
        }

        if(Admin::where('user_id', Auth::user()->id)->first()){
            return response()->json(['Cannot join to your owned room'], 400);
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
}
