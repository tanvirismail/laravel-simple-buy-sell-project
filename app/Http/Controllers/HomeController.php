<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->isAdmin()){
            return view('Admin.dashboard');
        } else {
            return view('User.dashboard');
        }
        
    }
}
