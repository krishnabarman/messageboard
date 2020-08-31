@extends('layouts.app')

@section('title','Message Board')

@section('content')

<div><a href="/messageboard/create" class="btn btn-success">Add New Message</a></div>

<h3>My Posts</h3> 

<ul class="list-group">
    @foreach ($messages as $message)
    <div class="row">
        <div class="col-md-1">
            <img class="img-thumbnail" style="width: 100%" src="/storage/messageboard/cover_images/{{ $message->cover_image }}" alt="{{ $message->cover_image }}">
        </div>
        <div class="col-md-10">
            <a href="/messageboard/{{ $message->id }}"> {{ $message->title }} </a>
        </div>



    </div>
        
    @endforeach
</ul>
<br/>
{{ $messages->links() }}




@endsection