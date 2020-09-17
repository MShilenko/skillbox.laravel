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
        $users = new User();
        $posts = new Post();

        /** Число записей в таблицах */
        $statistics['posts_count'] = DB::table('posts')->count();        
        $statistics['news_count'] = DB::table('news')->count();  

        /** Автор с максимальным числом постов */
        $statistics['best_author'] = $users->withCount('posts')->get(['id', 'name'])->sortBy('posts_count')->last();

        /** Самая длинная/короткая статья */
        $query = $posts->get(['title', 'text', 'slug'])->sortBy(function ($post) {
            $post->textLength = mb_strlen($post->text);
            return $post->textLength;
        });
        $statistics['longest_post'] = $query->last();
        $statistics['shortest_post'] = $query->first();

        /** Средние количество статей у “активных” пользователей */
        $statistics['avg_amount_posts'] = $users->withCount('posts')->get()->where('posts_count', '>', 1)->avg('posts_count');

        /** Статья которую меняли чаще */
        $statistics['biggest_history_post'] = $posts->withCount('history')->get(['title', 'slug'])->sortBy('history_count')->last();

        /** Самая обсуждаемая статья */
        $statistics['most_commented_post'] = $posts->withCount('comments')->get(['title', 'slug'])->sortBy('comments_count')->last();

        if (!Cache::tags("statistics")->has("statistics")) {
            Cache::tags("statistics")->put("statistics", $statistics, config('skillbox.cache.time'));    
        }

        $statistics = Cache::tags("statistics")->get("statistics", $statistics);

        return view('statistic', compact('statistics'));
    }
}

