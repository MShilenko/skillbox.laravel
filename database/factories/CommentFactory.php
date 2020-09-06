<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use App\News;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $classes = [Post::class, News::class];
    $rand = array_rand($classes, 1);

    return [
        'user_id' => User::inRandomOrder()->first(),
        'text' => $faker->words(rand(5, 20), true),
        'commentable_type' => $classes[$rand],
        'commentable_id' => $classes[$rand]::inRandomOrder()->first()->id
    ];
});