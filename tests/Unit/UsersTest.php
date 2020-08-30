<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAUserCanCreatePost()
    {
        $user = factory(User::class)->create();
        $attributes = factory(Post::class)->raw(['user_id' => $user]);

        $user->posts()->create($attributes);

        $this->assertEquals($attributes['title'], $user->posts->first()->title);
    }
}
