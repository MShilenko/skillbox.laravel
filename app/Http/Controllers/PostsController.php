<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\StoreAndUpdatePost;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts.index', ['posts' => Post::latest()->get()]);
    }

    /**
     * Получаем коллекцию(одну конкретную запись БД), Laravel сам находит нужную по id(или другому полю БД, переопределить поле можно в контроллере)
     * @param  Post   $post
     * @return view
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StoreAndUpdatePost $request)
    {
        $validated = $request->validated();
        $validated['public'] = (bool) $request->input('public');

        Post::create($validated);

        return redirect(route('main'));
    }

    public function update(StoreAndUpdatePost $request, Post $post){
        $validated = $request->validated();
        $validated['public'] = (bool) $request->input('public');

        $post->update($validated);

        return redirect(route('posts.show', ['post' => $post]));
    }

    public function edit(Post $post){
        return view('posts.edit', compact('post'));
    }

    public function destroy(Post $post){
        $post->delete();

        return redirect(route('main'));
    }
}
