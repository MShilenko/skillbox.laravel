<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    /** Свойство обновляет updated_at у связанных моделей, что позволяет точно отловить изменение, например если у статьи мы поменяли только теги */
    protected $touches = ['posts', 'news'];

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
        return static::has('posts')->orHas('news')->get();
    }

    public static function syncWithModel($model, string $tags)
    {
        foreach (explode(', ', $tags) as $tag) {
            $tagsIds[] = self::firstOrCreate(['name' => $tag])->id;
        }

        $model->tags()->sync(array_values($tagsIds));
    }
}
