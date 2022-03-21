@extends('layouts.app')

@section('title', 'Show Post')

@section('content')

            <h1 class="d-flex justify-content-center">Show Post</h1>

            <div class="container my-3">
                <div class="col-sm-3">
                    <a href="{{ route('post.index') }}" class="btn btn-secondary"><i class="fa-solid fa-house"></i></a>
                </div>
            </div>

            <!-- Table -->
            <div class="container w-50 p-3">
                <table class="table table-bordered table-hover">
                    {{-- <tr>
                        <th scope="col">ID</th>
                        <td>{{ $post->id }}</td>
                    </tr> --}}
                    <tr>
                        <th scope="col">Title</th>
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Image</th>
                        <td>
                            @if ($post->image && File::exists('images/posts/'.$post->image))
                                <img src="{{ asset('images/posts/'.$post->image) }}" class="img-thumbnail rounded" height="140px" width="140px" alt="">
                            @else
                                <img src="{{ asset('images/posts/noimage.jpg') }}" class="img-thumbnail rounded" height="140px" width="140px" alt="">
                            @endif
                        </td>
                    </tr>
                </table>
                <div class="container">
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <form action="{{ route('post.destroy',$post->id) }}" method="POST">
                            <a href="{{ route('post.edit',$post->id) }}" class="btn btn-warning">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Table End -->

            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="container p-3 border">
                <div class="d-flex justify-content-between">
                    <h5 class="diaplay-3">Comments: {{ $post->comments->count() }}</h5>
                    <a href="{{ route('post.comment.create',$post->id) }}" class="btn btn-success"><i class="fa-solid fa-plus"></i></a>
                </div>
                <table class="table table-secondary table-sm shadow table-hover table-fixed">
                    <thead>
                        <tr>
                            <th class="col-7">Description</th>
                            <th class="col-3">Updated At</th>
                            <th class="col-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                        <tr>
                            <td class="col-7">{{ $comment->description }}</td>
                            <td class="col-3">{{ $comment->updated_at }}</td>
                            <td class="col-2">
                                <form action="{{ route('post.comment.destroy',[$post->id, $comment->id]) }}" method="POST">
                                    <a href="{{ route('post.comment.edit',[$post->id, $comment->id]) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>               
            </div>

@endsection