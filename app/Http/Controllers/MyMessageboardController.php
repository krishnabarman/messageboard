<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyMessageboardController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id= Auth::id();//auth()->user()->id;
        $user = User::find($user_id);
        $messages = $user->messages()->orderBy('created_at','desc')->get();
        

        return view('pages.messageboard.my_messageboard',[
            'messages'=>$messages
        ]);

    }

}
