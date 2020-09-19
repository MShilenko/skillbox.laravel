<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class AdminPostsController extends PostsController
{
    protected static function booted()
    {
        parent::booted();
    }

    public function index()
    {
       /** Пример вывода только нужных полей из основной и связанной моделей */
        $perPage = config('skillbox.posts.paginate');
        $posts = Post::paginate($perPage);

        return view('posts.index', compact('posts'));
    }
}
