<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class ProfileController extends Controller
{
    public function profile(){
        return response()->json(Auth::user(), 200);
    }

    public function editProfileView(){
        // Under Contruction
    }

    public function editProfile(){
        
    }
}
