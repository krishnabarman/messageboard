@extends('layouts.app')

@section('title', $message->title)

@section('content')
<a href="/messageboard" class="btn btn-default"> Go Back </a>
    <h3>{{ $message->title }}
    </h3>
    <h5>Author:  {{ $message->user->name }} </h5>
    <h6>{{ $message->created_at->format('d/m/Y H:i') }}</h6>
    <p>
        {{ $message->content }}
    </p>
   @if(Auth::check()) 
    @if((Auth::id()) === $message->user_id)
        <div>
            <div class="btn-group pull-right">
                <span><a href="/messageboard/{{ $message->id }}/edit" class="btn btn-success">Edit</a></span>
           <span>

            {!! Form::open(['method' => 'POST', 'action' => ['MessageboardController@destroy',$message->id], 'class' => 'form-horizontal']) !!}
            
           
                {!! Form::hidden('_method','DELETE') !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
           
            {!! Form::close() !!}
           </span>
            </div>

        </div>
        @endif
    @endif
	
@endsection