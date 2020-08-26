<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class ProfileController extends Controller
{
    public function profile(){
        $data = Auth::user();
        return 
        view('pages.profile',compact('data'));
        // response()->json(Auth::user(), 200);
    }

    public function editProfileView(){
        // Under Contruction
    }

    public function editProfile(){
        
    }
}
