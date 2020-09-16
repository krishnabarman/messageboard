@extends('layouts.app')

@section('title', 'Message Board')

@section('content')

    @guest
        Please login to post a message
     
       
    @else
   
        <div><a href="/messages/create" class="btn btn-success">Add New Message</a></div>

    @endguest
    <h3>Recent Messages</h3>

    <ul class="list-group list-group-flush">

    <div>
       <show-messages></show-messages>
       
    </div>
   

@endsection
