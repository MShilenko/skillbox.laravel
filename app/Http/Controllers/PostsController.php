<?php

namespace App\Http\Controllers;

use App\Post;
use App\Service\Pushall;
use App\Tag;
use App\Http\Requests\StoreAndUpdatePost;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        /** middleware "из коробки" - указывает что доступ к указанным методам разрешен только зарегистрированным пользователям */
        $this->middleware('auth')->only(['store', 'update', 'edit', 'destroy', 'create']);

        /** Политики: в данном случае указано что для всех, кроме перечисленных методов, должна происходить проверка указанная в \App\Policies\PostPolicy:update */
        $this->middleware('can:update,post')->except(['index', 'show', 'create', 'store']);
    }

    public function index()
    {
        /** Пример вывода только нужных полей из основной и связанной таблицы */
        $rows = ['id', 'title', 'slug', 'created_at', 'excerpt'];
        $query = Post::select($rows)->with([
            'tags' => function ($tag) {
                $tag->select(['id', 'name']);
            }
        ])->latest();
        /** Здесь также дописываем запрос в зависимости от роута с которого от пришел */
        $posts = Route::currentRouteName() === "admin.posts.index" ? $query->get() : $query->where('public', true)->get($rows); 

        return view('posts.index', compact('posts'));
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
        $validated['user_id'] = \Auth::id();

        $post = Post::create($validated);

        if ($request->tags){
            $this->syncTags($post, $request->tags);
        }

        push_all("Создана новая статья", "{$post->title} | {$post->created_at}");

        flash('Статья успешно cоздана!');

        return redirect(route('main'));
    }

    public function update(StoreAndUpdatePost $request, Post $post)
    {
        $validated = $request->validated();

        $post->update($validated);

        if ($request->tags){
            $this->syncTags($post, $request->tags);
        }

        push_all("Изменена статья", "{$post->title} | {$post->updated_at}");

        flash('Статья успешно обновлена!');

        return redirect(route('posts.show', ['post' => $post]));
    }

    public function edit(Post $post){
        return view('posts.edit', compact('post'));
    }

    public function destroy(Post $post){
        $post->delete();

        flash('Статья удалена!', 'warning');

        return redirect(route('main'));
    }

    public function syncTags(Post $post, string $tags)
    {
        foreach (explode(', ', $tags) as $tag) {
            $tagsIds[] = Tag::firstOrCreate(['name' => $tag])->id;
        }

        $post->tags()->sync(array_values($tagsIds));
    }
}
