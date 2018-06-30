<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\categories;

class DashboardController extends Controller
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
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $posts = $user->posts;
        $categories = $user->categories;
        
        return view('dashboard')->with(['posts' => $posts, 'categories' => $categories ]);
    }
}
