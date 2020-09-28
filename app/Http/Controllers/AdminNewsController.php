<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Support\Facades\Cache;

class AdminNewsController extends NewsController
{
    protected static function booted()
    {
        parent::booted();
    }

    public function index()
    {
        $news = Cache::tags('news')->remember('admin.news', config('skillbox.cache.time'), function () {
            /** Пример вывода только нужных полей из основной и связанной моделей */
            $rows = ['id', 'title', 'slug', 'created_at', 'excerpt'];
            $perPage = config('skillbox.post.paginate');
            return News::select($rows)->with([
                'tags' => function ($tag) {
                    $tag->select(['id', 'name']);
                },
            ])->latest()->paginate($perPage);
        });

        return view('news.index', compact('news'));
    }
}
