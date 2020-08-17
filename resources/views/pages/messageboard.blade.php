@extends('layouts.app')

@section('title','Message Board')

@section('content')

<div>
   <h3> Post a message </h3>
   {!! Form::open(['action' => 'MessageController@store', 'method'=>'POST']) !!}
<div class="form-group">
    {{ Form::label('title','Title') }}
    {{ Form::text('title','',['class'=>'form-control','placeholder'=>'Title']) }}
</div>
<div class ="form-group">
    {{ Form::label('title','Content') }}
    {{ Form::textarea('content','',['class'=>'form-control','placeholder'=>'Content'])    }}
</div>
{{ Form::token() }}
{{ Form::submit('Submit',['class'=>'btn btn-primary']) }}
   
{!! Form::close() !!}
   
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
<h3>Recent Messages</h3>

<ul>
    @foreach ($messages as $message)
    <li>
       <a href="/messageboard/{{ $message->id }}"> {{ $message->title }} </a>
        <br>
        {{ $message->created_at->format('d/m/Y H:i') }}
    </li>
        
    @endforeach
</ul>
@endsection