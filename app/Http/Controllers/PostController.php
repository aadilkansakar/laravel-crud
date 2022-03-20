<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\fileExists;

class PostController extends Controller
{
    
    public function index()
    {
        $posts = Post::all();

        return view('index', compact('posts'));
    }

    public function create()
    {
        return view('create');
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


        return redirect('/')->with('success','Post Created Successfully');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        
        if ($request->hasFile('image')) {
            $destination = 'images/posts/'.$post->image;
            if (File::exists($destination)) {
                unlink($destination);
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

        return redirect('/')->with('success','Post Updated Successfully');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            $destination = 'images/posts/'.$post->image;
            if (File::exists($destination)) {
                unlink($destination);
            }
        }

        $post->delete();

        return redirect('/')->with('success','Post '.$post->title.' Deleted Successfully');
    }
}
