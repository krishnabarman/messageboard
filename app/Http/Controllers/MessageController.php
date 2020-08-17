<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){

        $messages = Message::all();

        return view('pages.messageboard',[
            'messages'=>$messages
        ]);

    }

    public function store(Request $request){

        $message= new Message();

        $message->title= filter_var($request->title, FILTER_SANITIZE_STRING);
        $message->content = filter_var($request->content, FILTER_SANITIZE_STRING);

        $message->save();

        return redirect ('/');

    }

    public function show($id){

        $message = Message::findOrFail($id);

        return view('pages.message',[
            'message' => $message
        ]);

        
    }
}
