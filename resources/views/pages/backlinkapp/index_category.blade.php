@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class=" card-header d-flex align-items-center justify-content-between">
                        <div class=" inline-block">
                            Categories
                        </div>
                        <div class="">
                            <a class="btn btn-warning" href="/admindashboard">Back </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <show-categories :categories="{{ $categories }}"></show-categories>
                </div>
            </div>
        </div>
    </div>

@endsection
