@extends('layouts.app')

@section('title','Message Board')

@section('content')

<div>
    @if($message->id ===0)
   <h3> Create message </h3>
   @else
   <h3> Edit message </h3>
   @endif
   {!! Form::model($message, ['action' =>['MessageboardController@update',$message->id], 'method' => 'PUT', 'enctype' => "multipart/form-data"]) !!}  
  
  
  {{--   {!! Form::open(['action' => ['MessageboardController@update',$message->id], 'method'=>'POST', 'enctype'=>"multipart/form-data"]) !!} --}}
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
{{-- {{ Form::hidden('_method','PUT') }}  --}}
{{ Form::submit('Submit',['class'=>'btn btn-primary']) }}
   
{!! Form::close() !!}
   
</div>
@endsection