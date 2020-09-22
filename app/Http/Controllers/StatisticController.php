<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index() 
    {
        $statistics = [];

        /** Число записей в таблицах */
        $statistics['posts_count'] = DB::table('posts')->count();        
        $statistics['news_count'] = DB::table('news')->count();  

        /** Автор с максимальным числом постов */
        $statistics['best_author'] = User::select(['id', 'name'])->withCount('posts')->orderBy('posts_count', 'desc')->first();

        /** Самая длинная/короткая статья */
        $statistics['longest_post'] = Post::select(['title', 'slug', 'text_length' => function ($query) {
            $query->selectRaw('LENGTH(text)');
        }])->orderBy('text_length', 'desc')->first();
        $statistics['shortest_post'] = Post::select(['title', 'slug', 'text_length' => function ($query) {
            $query->selectRaw('LENGTH(text)');
        }])->orderBy('text_length')->first();

        /** Средние количество статей у “активных” пользователей */
        $statistics['avg_amount_posts'] = User::withCount(['posts', 'posts as posts_count' => function ($query) {
            $query->where('posts_count', '>', 1);
        }])->pluck('posts_count')->avg();

        /** Статья которую меняли чаще */
        $statistics['biggest_history_post'] = Post::select(['title', 'slug'])->withCount('history')->orderBy('history_count', 'desc')->first();

        /** Самая обсуждаемая статья */
        $statistics['most_commented_post'] = Post::select(['title', 'slug'])->withCount('comments')->orderBy('comments_count', 'desc')->first();

        if (!Cache::tags("statistics")->has("statistics")) {
            Cache::tags("statistics")->put("statistics", $statistics, config('skillbox.cache.time'));    
        }

        $statistics = Cache::tags("statistics")->get("statistics", $statistics);

        return view('statistic', compact('statistics'));
    }
}

