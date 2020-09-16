@extends('layouts.app')

@section('title','Message Board')

@section('content')

<div>
    @if(collect($message)->isEmpty())
   <h3> Create message </h3>
   {!! Form::model($message, array('route' => array('messages.store'),'enctype' => "multipart/form-data")) !!}
   
   @else
   <h3> Edit message </h3>
   {!! Form::model($message, ['action' =>['MessageboardController@update',$message->slug], 'method' => 'POST', 'enctype' => "multipart/form-data"]) !!}  
   {{ Form::hidden('_method','PUT') }} 
   @endif
   
  
<div class="form-group">
    {{ Form::label('title','Title') }}
    {{ Form::text('title',old('title'),['class'=>'form-control','placeholder'=>'Title']) }}
</div>
<div class ="form-group">
    {{ Form::label('title','Content') }}
    {{ Form::textarea('content',old('content'),['class'=>'form-control','placeholder'=>'Content'])    }}
</div>
<div class=" form-group row">
    <div class="col-md-2">
        <img class="img-thumbnail" style="width: 100%" src="/storage/messageboard/cover_images/{{ $message->cover_image }}"
            alt="{{ $message->cover_image }}">
    </div>
</div>
<div class= "form-group">
    {{ Form::file('cover_image') }}    
</div>

{{ Form::submit('Submit',['class'=>'btn btn-primary']) }}
   
{!! Form::close() !!}
   
</div>
@endsection