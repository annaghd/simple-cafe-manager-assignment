<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
        $roles = [
            "is_manager" => $request->user()->authorizeRoles(['manager']),
            "is_waiter" => $request->user()->authorizeRoles(['waiter']),
        ];

        return view('home', compact('roles'));
    }


}
