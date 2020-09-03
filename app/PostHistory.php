<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostHistory extends Model
{
    protected $fillable = ['post_id', 'user_id', 'changes', 'created_at', 'updated_at'];

    /** Метод позволяет указать формат в котором поле будет хранится в модели */
    protected $casts = [
        'changes' => 'array',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function post()
    {
        $this->belongsTo(Post::class);
    }
}
