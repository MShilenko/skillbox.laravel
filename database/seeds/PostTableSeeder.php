<?php

use App\Comment;
use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 40)->create()->each(function ($post) {
            $post->tags()->saveMany(Tag::inRandomOrder()->limit(rand(2, 6))->get());
        });
    }
}
