<?php

namespace App\Http\Controllers;

use App\News;
use App\Service\Pushall;
use App\Tag;
use App\Http\Requests\StoreAndUpdateNews;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        /** Пример вывода только нужных полей из основной и связанной моделей */
        $news = Cache::tags('news')->remember('news', config('skillbox.cache.time'), function () {
            $rows = ['id', 'title', 'slug', 'created_at', 'excerpt'];
            $query = News::select($rows)->with([
                'tags' => function ($tag) {
                    $tag->select(['id', 'name']);
                }
            ])->latest();
            $perPage = config('skillbox.newss.paginate');
            /** Здесь также дописываем запрос в зависимости от роута с которого от пришел */
            return Route::currentRouteName() === "admin.news" ? $query->paginate($perPage) : $query->where('public', true)->paginate($perPage); 
        });

        return view('news.index', compact('news'));
    }

    /**
     * Получаем коллекцию(одну конкретную запись БД), Laravel сам находит нужную по id(или другому полю БД, переопределить поле можно в контроллере)
     * @param  News   $news
     * @return view
     */
    public function show(News $news)
    {
        if (!Cache::tags(["news|{$news->id}"])->has("news|{$news->id}")) {
            Cache::tags(["news|{$news->id}"])->put("news|{$news->id}", $news, config('skillbox.cache.time'));    
        }

        $news = Cache::tags(["news|{$news->id}"])->get("news|{$news->id}", $news);

        return view('news.show', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(StoreAndUpdateNews $request)
    {
        $validated = $request->validated();
        $validated['public'] = (bool) $request->input('public');
        $validated['user_id'] = \Auth::id();

        $news = News::create($validated);

        if ($request->tags){
            Tag::syncWithModel($news, $request->tags);
        }

        return redirect(route('news.show', ['news' => $news]));
    }

    public function update(StoreAndUpdateNews $request, News $news)
    {
        $validated = $request->validated();

        $news->update($validated);

        if ($request->tags){
            Tag::syncWithModel($news, $request->tags);
        }

        return redirect(route('news.show', ['news' => $news]));
    }

    public function edit(News $news){
        return view('news.edit', compact('news'));
    }

    public function destroy(News $news){
        $news->delete();

        return redirect(route('news'));
    } 
}
