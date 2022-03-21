@extends('layouts.app')

@section('title', 'Index')

@section('content')

            <h1 class="d-flex justify-content-center">Comments</h1>

            <div class="container my-3">
                <div class="col-sm-3">
                    <a href="{{ route('post.comment.create',$post->id) }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>Create Post</a>
                </div>
            </div>

            <!-- Table -->
            <div class="container">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</td>
                            <td><a href="{{ route('comments.show',$post->id) }}">{{ $comment->text }}</a></td>
                            <td>
                                <form action="{{ route('post.comment.destroy',$post->id) }}" method="POST">
                                    <a href="{{ route('post.comment.edit',$post->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>Delete</button>
                                </form>
                            </td>
                        </tr>                            
                        @endforeach
                    </tbody>
                </table>
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
            <!-- Table End -->

@endsection