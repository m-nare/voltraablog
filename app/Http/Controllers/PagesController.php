<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to the Blog!';
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $data = array(
            'title' => 'About',
            'version' => '1.0'
        ); 

        return view('pages.about')->with($data);
    }
}
