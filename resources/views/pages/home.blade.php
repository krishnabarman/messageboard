@extends('layouts.app')

@section('title', 'HomePage')

@section('content')
    <div class="row">
        <div class="col-6 d-flex flex-column justify-content-center">
            <div class="py-3">
                <h1> Link Building is one of the most important thing in <span class="textmaincolor">SEO </span></h1>
            </div>
            <div>
                <h4> Submit your domain and get dofollow backlink from our website</h4>
            </div>
            <div class="py-5"> <a class="btn btn-primary" href="{{ route('domain.create') }}">Submit Your Domain</a></div>

        </div>

        <div class="col-6">
            <h2 class="font-weight-bolder">Recent Messages</h2>
            @foreach ($messages as $message)
                <div class="row">
                    <div class="col-md-2">
                        <img class="img-thumbnail" style="width:100%"
                            src="/storage/messageboard/cover_images/{{ $message->cover_image }}"
                            alt="{{ $message->cover_image }}">
                    </div>
                    <div class="col-md-10">
                        <a href="/messages/{{ $message->slug }}"> {{ $message->title }} </a> by {{ $message->user->name }}

                    </div>
                </div>

            @endforeach
            <a href="/messageboard" class="btn btn-light">View More</a>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <h2 class="font-weight-bolder"> Categories</h2>
    </div>
    <show-domains :domains='{{ $domains }}' :categories = '{{ $categories }}' :subcategories = '{{ $subcategories }}'></show-domains>

@endsection
