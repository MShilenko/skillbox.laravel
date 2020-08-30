<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Checks if a user can create a post
     *
     * @return void
     */
    public function testAUserCanCreatePost()
    {
        /** actingAs авторизует тестового пользователя созданного при помощи фабрики */
        $this->actingAs($user = factory(User::class)->create());

        $attributes = factory(Post::class)->raw(['user_id' => $user]);

        $this->post('/', $attributes);

        $this->assertDatabaseHas('posts', $attributes);
    }
}
