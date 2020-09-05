<?php

use App\News;
use App\Tag;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(News::class, 40)->create()->each(function ($post) {
            $post->tags()->saveMany(Tag::inRandomOrder()->limit(rand(2, 6))->get());
        });
    }
}
