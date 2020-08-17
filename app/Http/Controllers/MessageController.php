<?php

namespace App\Http\Controllers;

use App\Message;
use Exception;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){

        $messages = Message::orderBy('created_at','desc')->get();

        return view('pages.messageboard',[
            'messages'=>$messages
        ]);

    }

    public function create(){
        return view('pages.create_message');
    }

    public function store(Request $request){

        $this->validate($request,[
            'title' => 'required',
            'content' => 'required'
        ]);
       
        $message= new Message();

        $message->title= filter_var($request->title, FILTER_SANITIZE_STRING);
        $message->content = filter_var($request->content, FILTER_SANITIZE_STRING);

        $message->save();

        return redirect ('/messageboard')->with('success', 'Message has been created successfully');

    }

    public function show($id){

        $message = Message::findOrFail($id);

        return view('pages.message',[
            'message' => $message
        ]);
        
    }
    public function edit($id){} // show edit page
    public function update(Request $request, $id){} // handle show edit page POST
    public function destroy($id){} // delete a message
}
