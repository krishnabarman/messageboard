<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $messages = Message::with('user')->orderBy('created_at', 'desc')->get();

        return view('pages.messageboard.index_message', [
            'messages' => $messages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.messageboard.create_message');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        } 

        $message = new Message();

        $message->title = $request->title;
        $message->content = $request->content;
        $message->user_id = auth()->user()->id;
        $message->cover_image = $filenameToStore;

        $message->save();

        return redirect('/messageboard')->with('success', 'Message has been created successfully');
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
            return redirect('/messageboard')->with('error', 'You do not own this post!');
        }

        return view('pages.messageboard.edit_message', [
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);

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
        } 

        $message->title = $request->title;
        $message->content = $request->content;
        if ($request->hasFile('cover_image')) {
            $message->cover_image = $filenameToStore;
        }

        $message->save();

        return redirect('/messageboard/' . $id)->with('success', 'Message has been updated successfully');
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
            return redirect('/messageboard')->with('error', 'You do not own this post!');
        }
        if($message->cover_image !=='noimage.jpg'){
            // delete cover_image from storage
            Storage::delete('public/messageboard/cover_images/'.$message->cover_image);
        }
        $message->delete();
        return redirect('/messageboard')->with('success', 'Message has been deleted successfully');
    }
}
