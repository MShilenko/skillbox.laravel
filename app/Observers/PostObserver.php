<?php

namespace App\Observers;

use App\Post;
use App\User;
use App\Notifications\PostUpdated;
use App\Notifications\PostCreated;
use App\Notifications\PostDeleted;
use Illuminate\Support\Facades\Notification;

class PostObserver
{
    //use Notifiable;

    /**
     * Handle the post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        $this->sendNotificationToAdmin(new PostCreated($post));
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        $this->sendNotificationToAdmin(new PostUpdated($post));
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        $this->sendNotificationToAdmin(new PostDeleted($post));
    }

    /**
     * Handle the post "restored" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        $this->sendNotificationToAdmin(new PostDeleted($post));
    }

    /**
     * Send notification to admin
     * @param  $notificationType
     * @return void
     */
    public function sendNotificationToAdmin($notificationType)
    {
        Notification::route('mail', config('skillbox.my_email'))->notify($notificationType);
    }
}
