<?php

namespace App\Http\Controllers;

use App\News;
use App\Service\Pushall;
use App\Tag;
use App\Http\Requests\StoreAndUpdateNews;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class AdminNewsController extends NewsController
{
    public function index()
    {
        /** Пример вывода только нужных полей из основной и связанной моделей */
        $rows = ['id', 'title', 'slug', 'created_at', 'excerpt'];
        $perPage = config('skillbox.newss.paginate');
        $news = News::select($rows)->with([
            'tags' => function ($tag) {
                $tag->select(['id', 'name']);
            }
        ])->latest()->paginate($perPage);

        return view('news.index', compact('news'));
    }
}
