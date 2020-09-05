<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use App\User;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->words(rand(2, 6), true),
        'slug' => $faker->unique()->slug(),
        'excerpt' => $faker->words(rand(10, 30), true),
        'text' => $faker->words(rand(10, 30), true),
        'public' => rand(0, 1),
        'user_id' => User::inRandomOrder()->first(),
    ];
});
