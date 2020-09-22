<?php

namespace App\Http\Controllers;

use App\Post;

class AdminPostsController extends PostsController
{
    protected static function booted()
    {
        parent::booted();
    }

    public function index()
    {
        $posts = Cache::tags('posts')->remember('posts', config('skillbox.cache.time'), function () {
            /** Пример вывода только нужных полей из основной и связанной моделей */
            $rows = ['id', 'title', 'slug', 'created_at', 'excerpt'];
            $perPage = config('skillbox.posts.paginate');
            $posts = Post::select($rows)->with([
                'tags' => function ($tag) {
                    $tag->select(['id', 'name']);
                },
            ])->latest()->paginate($perPage);
        });

        return view('posts.index', compact('posts'));
    }
}
