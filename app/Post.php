<?php

namespace App;

class Post extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'text'];

    /**
     * Указываем по какому полю из БД выбирать записи по умолчанию
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}