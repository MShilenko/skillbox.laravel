<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Tag $tag) 
    {
        $select = ['title', 'slug', 'created_at', 'excerpt'];
        $perPage = config('skillbox.posts.paginate');
        $posts = $tag->posts()->with('tags:name')->get($select);
        $news = $tag->news()->with('tags:name')->get($select);
        $posts = $posts->concat($news);

        return view('posts.index', compact('posts'));
    }
}
