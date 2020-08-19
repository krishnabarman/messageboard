@extends('layouts.app')

@section('title', 'HomePage')

@section('content')
    
        <h3>Recent Messages</h3>
        @foreach ($messages as $message)
        <div class="row">
            <div class="col-md-1">
                <img style="width:100%" src="/storage/messageboard/cover_images/{{ $message->cover_image }}"
                    alt="{{ $message->cover_image }}">
            </div>
            <div class="col-md-10">
                <a href="/messageboard/{{ $message->id }}"> {{ $message->title }} </a> by {{ $message->user->name }}

            </div>
          </div>

        @endforeach
    
    <div class="row"><a href="/messageboard" class="btn btn-light">View More</a></div>

@endsection
