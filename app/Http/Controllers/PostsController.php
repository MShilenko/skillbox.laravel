<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAndUpdatePost;
use App\Post;
use App\Scopes\PostAndNewsIndexScope;
use App\Service\AddCommentService;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class PostsController extends Controller
{
    public function __construct()
    {
        /** middleware "из коробки" - указывает что доступ к указанным методам разрешен только зарегистрированным пользователям */
        $this->middleware('auth')->only(['store', 'update', 'edit', 'destroy', 'create']);

        /** Политики: в данном случае указано что для всех, кроме перечисленных методов, должна происходить проверка указанная в \App\Policies\PostPolicy:update */
        $this->middleware('can:update,post')->except(['index', 'show', 'create', 'store']);
    }

    protected static function booted()
    {
        static::addGlobalScope(new PostAndNewsIndexScope);
    }

    public function index()
    {
        $posts = Cache::tags('posts')->remember('posts', config('skillbox.cache.time'), function () {
            /** Пример вывода только нужных полей из основной и связанной моделей */
            $rows = ['id', 'title', 'slug', 'created_at', 'excerpt'];
            $perPage = config('skillbox.posts.paginate');
            return Post::select($rows)
                ->with([
                    'tags' => function ($tag) {
                        $tag->select(['id', 'name']);
                    },
                ])
                ->latest()
                ->where('public', true)
                ->paginate($perPage);
        });

        return view('posts.index', compact('posts'));
    }

    /**
     * Получаем коллекцию(одну конкретную запись БД), Laravel сам находит нужную по id(или другому полю БД, переопределить поле можно в контроллере)
     * @param  Post   $post
     * @return view
     */
    public function show(Post $post)
    {
        if (!Cache::tags(["post|{$post->id}"])->has("post|{$post->id}")) {
            Cache::tags(["post|{$post->id}"])->put("post|{$post->id}", $post, config('skillbox.cache.time'));
        }

        $post = Cache::tags(["post|{$post->id}"])->get("post|{$post->id}", $post);

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
        $validated['user_id'] = \Auth::id();

        $post = Post::create($validated);

        if ($request->tags) {
            Tag::syncWithModel($post, $request->tags);
        }

        return redirect(route('main'));
    }

    public function update(StoreAndUpdatePost $request, Post $post)
    {
        $validated = $request->validated();

        $post->update($validated);

        if ($request->tags) {
            Tag::syncWithModel($post, $request->tags);
        }

        return redirect(route('posts.show', ['post' => $post]));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect(route('main'));
    }

    public function comment(Request $request, Post $post)
    {
        AddCommentService::addComment($request, $post);

        return redirect()->route('posts.show', ['post' => $post]);
    }
}
