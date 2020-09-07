<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $bestAuthorId = DB::table('posts')
            ->select(DB::raw('count(*) as posts_count, user_id'))
            ->groupBy('user_id')
            ->orderBy('posts_count', 'DESC')
            ->first()
            ->user_id;
        $statistics['best_author'] = \App\User::find($bestAuthorId);

        /** Самая длинная/короткая статья */
        $statistics['longest_post'] = DB::table('posts')
            ->select(DB::raw('title, slug, LENGTH(text) as length'))
            ->orderBy('length', 'DESC')
            ->first();  
        $statistics['shortest_post'] = DB::table('posts')
            ->select(DB::raw('title, slug, LENGTH(text) as length'))
            ->orderBy('length')
            ->first();  

        /** Средние количество статей у “активных” пользователей */
        $statistics['avg_amount_posts'] = DB::table('posts')
            ->select(DB::raw('count(*) as posts_count, user_id'))
            ->having('posts_count', '>', 1)
            ->groupBy('user_id')
            ->get()
            ->avg('posts_count');

        /** Статья которую меняли чаще */
        $postFromHistory = DB::table('post_histories')
            ->select(DB::raw('count(*) as changes_count, post_id'))
            ->groupBy('post_id')
            ->orderBy('changes_count', 'DESC')
            ->first()
            ->post_id;
        $statistics['biggest_history_post'] = \App\Post::find($postFromHistory);

        /** Самая обсуждаемая статья */
        $postFromComments = DB::table('comments')
            ->select(DB::raw('count(*) as comments_count, commentable_id'))
            ->where('commentable_type', \App\Post::class)
            ->groupBy('commentable_id')
            ->orderBy('comments_count', 'DESC')
            ->first()
            ->commentable_id;
        $statistics['most_commented_post'] = \App\Post::find($postFromComments);

        return view('statistic', compact('statistics'));
    }
}

