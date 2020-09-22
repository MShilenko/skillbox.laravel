<?php

namespace App;

use App\Interfaces\Commentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Post extends Model implements Commentable
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
            Cache::tags(["posts", "post|{$model->id}", "posts_tags", "tags_cloud", "statistics"])->flush();
            push_all("Изменена статья", "{$model->title} | {$model->updated_at}");
            flash('Статья успешно обновлена!');
        });

        static::created(function($model) {
            Cache::tags(["posts", "posts_tags", "tags_cloud", "statistics"])->flush();
            push_all("Создана новая статья", "{$model->title} | {$model->created_at}");
            flash('Статья успешно cоздана!');
        });

        static::deleted(function($model) {
            Cache::tags(["posts", "post|{$model->id}", "posts_tags", "tags_cloud", "statistics"])->flush();
            flash('Статья удалена!', 'warning');
        });

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
        return $this->belongsToMany(User::class, 'post_histories')->using(PostHistory::class)->withPivot(['changes', 'created_at']);
    }
}