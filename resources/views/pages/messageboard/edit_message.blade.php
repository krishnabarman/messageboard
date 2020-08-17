@extends('layouts.app')

@section('title','Message Board')

@section('content')

<div>
   <h3> Edit message </h3>
   {!! Form::open(['action' => ['MessageboardController@update',$message->id], 'method'=>'POST']) !!}
<div class="form-group">
    {{ Form::label('title','Title') }}
    {{ Form::text('title',$message->title,['class'=>'form-control','placeholder'=>'Title']) }}
</div>
<div class ="form-group">
    {{ Form::label('title','Content') }}
    {{ Form::textarea('content',$message->content,['class'=>'form-control','placeholder'=>'Content'])    }}
</div>
{{ Form::hidden('_method','PUT') }}
{{ Form::submit('Submit',['class'=>'btn btn-primary']) }}
   
{!! Form::close() !!}
   
</div>
@endsection