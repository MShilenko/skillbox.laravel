<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'public', 'text', 'tags', 'user_id'];

    /**
     * Указываем по какому полю из БД выбирать записи по умолчанию
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function booted() 
    {
        static::updating(function ($post) {
            $post->history()->attach(Auth::id(), [
                'changes' => json_encode($post->getDirty()),
            ]);
        });
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function history()
    {
        return $this->belongsToMany(User::class, 'post_histories')->withPivot(['changes'])->withTimestamps();
    }
}