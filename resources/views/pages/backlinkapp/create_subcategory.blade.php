@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class=" card-header d-flex align-items-center justify-content-between">
                        <div class=" inline-block">
                            Admin Dashboard
                        </div>
                        <div class="">
                            <a class="btn btn-warning" href="/admindashboard">Back </a>
                        </div>
                    </div>
                    <div class="card-body">
                        Add Category
                        <div class=" d-flex align-items-center mt-4">
                            <form method="POST" action="{{ route('subcategory.store') }}">
                                @csrf
                                <div class=" form-group">
                                    <label for="selectcategory">Select Category</label>
                                    <select class=" form-control" id="selectcategory" name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="category">Enter Subcategory </label>
                                    <input type="text" class=" form-control" name="subcategory_name">
                                    @error('subcategory_name')
                                    <div class=" error text-danger">{{ $message }}
                                        @enderror
                                    </div>
                                    <button type="submit" class=" btn btn-primary">Submit</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
