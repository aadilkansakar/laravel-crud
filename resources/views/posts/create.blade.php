@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

            <h1 class="d-flex justify-content-center">Create New Post</h1>

            {{-- <div class="container my-3">
                <div class="col-sm-3">
                    <a href="/create" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>Create</a>
                </div>
            </div> --}}

            <form class="container mt-5 w-50 p-3" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="title" value="{{ old('title') }}">

                    @error('title')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    @error('image')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

@endsection