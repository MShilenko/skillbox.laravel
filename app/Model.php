<?php

namespace App;

class Model extends \Illuminate\Database\Eloquent\Model 
{
    /** Первое - массив разрешенных к массовому добавлению в БД полейЮ второе - запрещенных */
	// protected $fillable = ['title', 'body'];
    protected $guarded = [];
}