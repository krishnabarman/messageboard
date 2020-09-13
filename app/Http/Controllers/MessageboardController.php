<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageCollection;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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

       //return view('pages.messageboard.index_message')->with('messages',$messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $message = new Message();
        $message->id = 0;

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
        return $this->update($request, $message->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::with('user')->findOrFail($id);

        return view('pages.messageboard.show_message', [
            'message' => $message
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::findOrFail($id);

        if (Auth::User()->id !== $message->user_id) {
            return redirect('/posts')->with('error', 'You do not own this post!');
        }

        return view('pages.messageboard.create_edit_message')->with('message', $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     *  @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = Message::findOrNew($id);

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

        //$message = Message::findOrFail($id);

        $message->fill($request->all());

        // $message->title = $request->title;
        //$message->content = $request->content;

        if ($request->hasFile('cover_image')) {
            $message->cover_image = $filenameToStore;
        } else {
        }
        $message->user_id = auth()->user()->id;

        $message->save();


        return redirect('/posts')->with('success', 'Message has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $message = Message::findOrFail($id);
        if (Auth::User()->id !== $message->user_id) {
            return redirect('/posts')->with('error', 'You do not own this post!');
        }
        if ($message->cover_image !== 'noimage.jpg') {
            // delete cover_image from storage
            Storage::delete('public/messageboard/cover_images/' . $message->cover_image);
        }
        $message->delete();
        return redirect('/posts')->with('success', 'Message has been deleted successfully');
    }
}
