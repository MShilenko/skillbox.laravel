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
    protected static function booted()
    {
        parent::booted();
    }

    public function index()
    {
       /** Пример вывода только нужных полей из основной и связанной моделей */
        $perPage = config('skillbox.posts.paginate');
        $news = News::paginate($perPage);

        return view('news.index', compact('news'));
    }
}
