@extends('layouts.app')

@section('title', $message->title)
	
@section('content')
    <h3>{{ $message->title }}
    </h3>
    <br/> {{ $message->created_at->format('d/m/Y H:i') }}
    <p>
        {{ $message->content }}
    </p>
    <p>
    <a href="/"> Back </a>
	
@endsection