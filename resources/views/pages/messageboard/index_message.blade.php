@extends('layouts.app')

@section('title', 'Message Board')

@section('content')

    @guest
        Please login to post a message
    @else
        <div><a href="/messageboard/create" class="btn btn-success">Add New Message</a></div>
        <div>
        @endguest
        <h3>Recent Messages</h3>

        <ul class="list-group list-group-flush">

            @foreach ($messages as $message)
                <div class="row">
                    <div class="col-md-2">
                        <img style="width: 100%" src="/storage/messageboard/cover_images/{{ $message->cover_image }}" alt="{{ $message->cover_image }}">
                    </div>
                    <div class="col-md-8">
                        <a href="/messageboard/{{ $message->id }}"> {{ $message->title }} </a> by {{ $message->user->name }}
                    </div>



                </div>

            @endforeach
        </ul>
    </div>
@endsection
