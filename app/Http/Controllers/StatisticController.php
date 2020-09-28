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
        $statistics = Cache::tags('statistic')->remember('statistic', config('skillbox.cache.time'), function () {
            $result = [];

            /** Число записей в таблицах */
            $result['posts_count'] = DB::table('posts')->count();        
            $result['news_count'] = DB::table('news')->count();  

            /** Автор с максимальным числом постов */
            $result['best_author'] = User::select(['id', 'name'])->withCount('posts')->orderBy('posts_count', 'desc')->first();

            /** Самая длинная/короткая статья */
            $result['longest_post'] = Post::select(['title', 'slug', 'text_length' => function ($query) {
                $query->selectRaw('LENGTH(text)');
            }])->orderBy('text_length', 'desc')->first();
            $result['shortest_post'] = Post::select(['title', 'slug', 'text_length' => function ($query) {
                $query->selectRaw('LENGTH(text)');
            }])->orderBy('text_length')->first();

            /** Средние количество статей у “активных” пользователей */
            $result['avg_amount_posts'] = User::withCount(['posts', 'posts as posts_count' => function ($query) {
                $query->where('posts_count', '>', 1);
            }])->pluck('posts_count')->avg();

            /** Статья которую меняли чаще */
            $result['biggest_history_post'] = Post::select(['title', 'slug'])->withCount('history')->orderBy('history_count', 'desc')->first();

            /** Самая обсуждаемая статья */
            $result['most_commented_post'] = Post::select(['title', 'slug'])->withCount('comments')->orderBy('comments_count', 'desc')->first();

            return $result;
        });

        return view('statistic', compact('statistics'));
    }
}

