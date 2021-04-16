<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;

class ProfileController extends Controller
{
    public function profile(){
        $data = Auth::user();
        return 
        view('pages.profile',compact('data'));
        // response()->json(Auth::user(), 200);
    }

    public function editProfileView(){
        $data = User::where('id', Auth::id())->get();
        return view('pages.editProfile', compact('data'));
    }

    public function editProfile(Request $request){
        User::where('id', $request -> id)
        ->update(
            ['name' => $request -> name],
            ['email' => $request -> email]
        );
        return redirect('/profile');
    }
}
