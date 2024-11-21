<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Mail\PostCreatedMail;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\form;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')
            ->paginate(10);

        return view("posts.index", compact('posts'));
    }

    public function store(StorePostRequest $request)
    {
        // $request->validate([
        //     'title' => ['required', 'min:5', 'max:200'],
        //     'slug' => 'required|unique:posts',
        //     'category' => 'required',
        //     'content' => 'required',
        // ]);

        $post = Post::create($request->all());

        Mail::to('prueba@prueba.com')->send(new PostCreatedMail($post));

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        // $post = Post::find($post);
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function edit(Post $post)
    {
        // $post = Post::find($post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // $post =  Post::find($post);
        $request->validate([
            'title' => ['required', 'min:5', 'max:200'],
            'slug' => "required|unique:posts,slug,{$post->id}",
            'category' => 'required',
            'content' => 'required',
        ], [
            'title' => 'The :attribute is not empty',
        ], [
            'title' => 'name',
        ]);

        $post->update($request->all());
        // $post->title = $request->title;
        // $post->slug = $request->slug;
        // $post->category = $request->category;
        // $post->content = $request->content;

        // $post->save();

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        // $post = Post::find($post);

        $post->delete();
        return redirect()->route('posts.index');
    }
}
