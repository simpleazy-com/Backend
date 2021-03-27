<?php

namespace App\Http\Controllers;


use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Group;
use App\Admin;
use App\Member;
use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['id'] = Admin::where('user_id', Auth::id())->get();
        $data['owned'] = Admin::where('user_id', Auth::id())
        ->join('groups','admins.group_id','groups.id')
        ->where('role', 'owner')
        ->get();
        $data['joined'] = Member::where('user_id', Auth::id())->get();
        return view('pages.dashboard', compact('data'));
    }   
}
