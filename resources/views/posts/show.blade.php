@extends('layouts.app')

@section('title', 'Show Post')

@section('content')

            <h1 class="d-flex justify-content-center">Show Post</h1>

            <!-- Table -->
            <div class="container w-50 p-3">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th scope="col">ID</th>
                        <td>{{ $post->id }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Title</th>
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Image</th>
                        <td>
                            @if ($post->image && File::exists('images/posts/'.$post->image))
                                <img src="{{ asset('images/posts/'.$post->image) }}" height="70px" width="70px" alt="">
                            @else
                                <img src="{{ asset('images/posts/noimage.jpg') }}" height="70px" width="70px" alt="">
                            @endif
                        </td>
                    </tr>
                </table>
                <div class="container">
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <form action="{{ route('post.destroy',$post->id) }}" method="POST">
                            <a href="{{ route('post.comment.index',$post->id) }}" class="btn btn-primary">Comments</a>
                            <a href="{{ route('post.edit',$post->id) }}" class="btn btn-warning">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Table End -->

            {{-- <div class="container w-50 p-3">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td>{{ $comment->text }}</td>
                    </tr>
                </table>
            </div> --}}

@endsection