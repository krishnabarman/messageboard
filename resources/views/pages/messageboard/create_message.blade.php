@extends('layouts.app')

@section('title','Message Board')

@section('content')

<div>
   <h3> Post a message </h3>
   {!! Form::open(['action' => 'MessageboardController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
<div class="form-group">
    {{ Form::label('title','Title') }}
    {{ Form::text('title','',['class'=>'form-control','placeholder'=>'Title']) }}
</div>
<div class ="form-group">
    {{ Form::label('title','Content') }}
    {{ Form::textarea('content','',['class'=>'form-control','placeholder'=>'Content'])    }}
</div>
<div class= "form-group">
    {{ Form::file('cover_image') }}    
</div>
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
@endsection