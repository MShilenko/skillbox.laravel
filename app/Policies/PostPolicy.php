<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $this->isOwner($user, $post);
    }

    /**
     * Checking if the user is the creator of the post
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function isOwner(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
