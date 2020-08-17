<?php

namespace App\Http\Controllers;

use App\Message;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {       

        //show 5 recent messages
            $messages = Message::orderBy('created_at','desc')->take(5)->get();
    
            return view("pages.home",[
                'messages' => $messages
            ]);
       
    }
}
