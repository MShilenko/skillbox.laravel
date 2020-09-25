<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAndUpdateNews;
use App\News;
use App\Scopes\PostAndNewsIndexScope;
use App\Service\AddCommentService;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class NewsController extends Controller
{
    protected static function booted()
    {
        static::addGlobalScope(new PostAndNewsIndexScope);
    }

    public function index()
    {
        $news = Cache::tags('news')->remember('news', config('skillbox.cache.time'), function () {
            /** Пример вывода только нужных полей из основной и связанной моделей */
            $rows = ['id', 'title', 'slug', 'created_at', 'excerpt'];
            $perPage = config('skillbox.posts.paginate');
            return News::select($rows)
                ->with([
                    'tags' => function ($tag) {
                        $tag->select(['id', 'name']);
                    },
                ])
                ->latest()
                ->where('public', true)
                ->paginate($perPage);
        });

        return view('news.index', compact('news'));
    }

     /**
     * Получаем коллекцию(одну конкретную запись БД), Laravel сам находит нужную по id(или другому полю БД, переопределить поле можно в контроллере)
     * @param  string $slug
     * @return view
     */
    public function show(string $slug)
    {
        if (!Cache::tags(["news|{$slug}"])->has("news|{$slug}")) {
            Cache::tags(["news|{$slug}"])->put("news|{$slug}", News::where('slug', $slug)->firstOrFail(), config('skillbox.cache.time'));
        }

        $news = Cache::tags(["news|{$slug}"])->get("news|{$slug}");

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

        if ($request->tags) {
            Tag::syncWithModel($news, $request->tags);
        }

        flash('Статья успешно cоздана!');

        return redirect(route('news.show', ['news' => $news]));
    }

    public function update(StoreAndUpdateNews $request, News $news)
    {
        $validated = $request->validated();

        $news->update($validated);

        if ($request->tags) {
            Tag::syncWithModel($news, $request->tags);
        }

        flash('Статья успешно обновлена!');

        return redirect(route('news.show', ['news' => $news]));
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function destroy(News $news)
    {
        $news->delete();

        flash('Новость удалена!', 'warning');

        return redirect(route('news'));
    }

    public function comment(Request $request, News $news)
    {
        AddCommentService::addComment($request, $news);

        return redirect()->route('news.show', ['news' => $news]);
    }
}
