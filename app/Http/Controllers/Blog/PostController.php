<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        // dd($request);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $file->move('images/posts/', $fileName);
            Post::create($request->safe()->only(['title']) + ['image' => $fileName]);
        }
        else {
            Post::create($request->validated());
        }


        return redirect()->route('post.index')->with('success','Post Created Successfully');
    }

    public function show(Post $post)
    {
        // $post = Post::findOrFail($id);

        $comments = Post::find($post->id)->comments;

        return view('posts.show', compact('post','comments'));
    }

    public function edit(Post $post)
    {
        // $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        // $post = Post::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($post->image) {
                $destination = 'images/posts/'.$post->image;
                if (File::exists($destination)) {
                    unlink($destination);
                }
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $file->move('images/posts/', $fileName);
            $post->update($request->safe()->only(['title']) + ['image' => $fileName]);
        }
        else {
            $post->update($request->validated());
        }

        return redirect()->route('post.index')->with('success','Post Updated Successfully');
    }

    public function destroy(Post $post)
    {
        // $post = Post::findOrFail($id);

        if ($post->image) {
            $destination = 'images/posts/'.$post->image;
            if (File::exists($destination)) {
                unlink($destination);
            }
        }

        $post->delete();

        return redirect()->route('post.index')->with('success','Post '.$post->title.' Deleted Successfully');
    }
}
