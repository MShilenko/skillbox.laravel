<?php

use App\Post;
use App\Tag;
use App\User;
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
        factory(Post::class, 20)->create()->each(function($post) {
            $post->tags()->saveMany(Tag::inRandomOrder()->limit(rand(2, 6))->get());
        });
    }
}
