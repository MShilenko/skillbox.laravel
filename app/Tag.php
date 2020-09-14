<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public static function tagsCloud()
    {
        $tagsCloud = Cache::tags('tags_cloud')->remember('tags_cloud', config('skillbox.cache.time'), function () {
            return static::has('posts')->orHas('news')->get();
        });

        return $tagsCloud;
    }

    public static function syncWithModel($model, string $tags)
    {
        foreach (explode(', ', $tags) as $tag) {
            $tagsIds[] = self::firstOrCreate(['name' => $tag])->id;
        }

        $model->tags()->sync(array_values($tagsIds));
    }
}
