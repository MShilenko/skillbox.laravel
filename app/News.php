<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class News extends Model
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
        static::updated(function($model) {
            Cache::tags(["news", "news|{$model->id}", "posts_tags", "tags_cloud", "statistics"])->flush();
            flash('Новость успешно обновлена!');
        });

        static::created(function($model) {
            Cache::tags(["posts", "posts_tags", "tags_cloud", "statistics"])->flush();
            flash('Новость успешно cоздана!');
        });

        static::deleted(function($model) {
            Cache::tags(["news", "news|{$model->id}", "posts_tags", "tags_cloud", "statistics"])->flush();
            flash('Новость удалена!', 'warning');
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
}
