<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageCollection;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;

class MessageboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = new MessageCollection(Message::with('user')->orderBy('created_at', 'desc')->get());

        return $messages;

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $message = new Message();        

        return view('pages.messageboard.create_edit_message')->with('message', $message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new Message();
        
        return $this->update($request, $message);

    }

 /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    
    public function show(Message $message)
    {       
        // Because of route model binding we now have access to the $message object! no need to find it!


        return view('pages.messageboard.show_message', [
            'message' => $message
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
    * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message  $message)
    {
        //$message = Message::findOrFail($message);
        // Because of route model binding we now have access to the $message object! no need to find it!

        if (Auth::User()->id !== $message->user_id) {
            return redirect('/messageboard')->with('error', 'You do not own this post!');
        }

        return view('pages.messageboard.create_edit_message')->with('message', $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request    
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message  $message)
    {
        //$message = Message::findOrNew($message);
        // Because of route model binding we now have access to the $message object! no need to find it!

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        $filenameToStore = "noimage.jpeg";
        //Handle file upload
        if ($request->hasFile('cover_image')) {
            //get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            //get file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get file extension
            $fileExt = $request->file('cover_image')->getClientOriginalExtension();

            //file name to store in database
            $filenameToStore = $filename . '_' . time() . $fileExt;
            //upload image in storage
            $filepath = $request->file('cover_image')->storeAs('public/messageboard/cover_images', $filenameToStore);
            $message->cover_image = $filenameToStore;
        } else {
            $existing_img = $message->getOriginal('cover_image');
            if (isset($existing_img) === false) { // if cover_image already exist then no need to update, otherwise put default value
                $message->cover_image = $filenameToStore;
            }
        }
       
        //$message->slug = SlugService::createSlug(Message::class, 'slug', $request->title);

        $message->fill($request->all());
        
        $message->user_id = auth()->user()->id;

        $message->save();


        return redirect('/messageboard')->with('success', 'Message has been saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message  $message)
    {

        //$message = Message::findOrFail($message);
        if (Auth::User()->id !== $message->user_id) {
            return redirect('/messageboard')->with('error', 'You do not own this post!');
        }
        if ($message->cover_image !== 'noimage.jpeg') {
            // delete cover_image from storage
            Storage::delete('public/messageboard/cover_images/' . $message->cover_image);
        }
        $message->delete();
        return redirect('/messageboard')->with('success', 'Message has been deleted successfully');
    }
}
