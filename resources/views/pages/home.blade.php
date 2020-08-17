@extends('layouts.app')

@section('title','HomePage')

@section('content')

<h3>Recent Messages</h3>

<div class="card">
<ul >
    @foreach ($messages as $message)
    <li>
      <a href="/messageboard/{{ $message->id }}"> {{ $message->title }} </a> by {{ $message->user->name }}
  
    </li>
        
    @endforeach
</ul>
<div><a href="/messageboard" >View More</a></div>
</div>
@endsection