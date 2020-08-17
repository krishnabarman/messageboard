@extends('layouts.app')

@section('title','Message Board')

@section('content')

<div>  
   
    <!-- <form action="messageboard" method="POST" id="store">
        <p>
        <input type="text" name="title" placeholder="Title">
        </p>
        <p>
        <textarea name="content" placeholder="Content" rows="10" cols="50"></textarea>
        </p>
        {{ csrf_field() }}
        
        <button type="submit">Submit</button>
    </form> !-->
</div>
<div><a href="/messageboard/create">Add New Message</a></div>
<div>
<h3>My Posts</h3> 

<ul class="list-group">
    @foreach ($messages as $message)
    <li class="list-item">
       <a href="/messageboard/{{ $message->id }}"> {{ $message->title }} </a>        
    </li>
        
    @endforeach
</ul>
</div>
@endsection