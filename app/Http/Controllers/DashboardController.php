<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Group;
use App\Admin;

use Auth;

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
        $id = Admin::where('user_id', Auth::id())->get();
        return view('home', compact('id'));
    }   
}
