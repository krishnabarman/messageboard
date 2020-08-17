@extends('layouts.app')

@section('title','HomePage')

@section('content')

<h3>Recent Messages</h3>

<div class="card">
<ul >
    @foreach ($messages as $message)
    <li>
      <h6> <a href="/messageboard/{{ $message->id }}"> {{ $message->title }} </a></h6>
        <small>
        {{ $message->created_at->format('d/m/Y H:i') }}
        </small>
    </li>
        
    @endforeach
</ul>
<div><a href="/messageboard" >View More</a></div>
</div>
@endsection