@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class=" card-header d-flex align-items-center justify-content-between">
                    <div class=" inline-block">
                        Admin Dashboard
                    </div>
                   
                </div>
                <div class="card-body">
                    <div class=" d-flex align-items-center">
                        <a class="btn btn-success w-50 m-1" href="{{ route('category.index') }}">Show Categories</a>
                    </div>
                   
                    <div class=" d-flex align-items-center">
                        <a class="btn btn-success w-50 m-1" href="{{ route('category.create') }}">Add Category</a>
                    </div>
                    <div class=" d-flex align-items-center">
                        <a class="btn btn-success w-50 m-1" href="{{ route('subcategory.create') }}">Add Subcategory</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection