@extends('layouts.app')

@section('title', $message->title)

@section('content')
    <a href="/messageboard" class="btn btn-default"> Go Back </a>
    <h3>{{ $message->title }}
    </h3>
    <h5>Author: {{ $message->user->name }} </h5>
    <h6>{{ $message->created_at->format('d/m/Y H:i') }}</h6>
    <div class="row">
        <div class="col-md-4">
            <img style="width: 100%" src="/storage/messageboard/cover_images/{{ $message->cover_image }}"
                alt="{{ $message->cover_image }}">
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ $message->content }}
            </div>
        </div>
        @if (Auth::check())
            @if (Auth::id() === $message->user_id)
                <div class="btn-group pull-right">
                    <div class="row">
                        <div class="col-md-4"><a href="/messageboard/{{ $message->id }}/edit"
                                class="btn btn-success">Edit</a></div>
                        <div class="col-md-4">

                            {!! Form::open(['method' => 'POST', 'action' => ['MessageboardController@destroy',
                            $message->id], 'class' => 'form-horizontal']) !!}


                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            @endif
        @endif

    @endsection
