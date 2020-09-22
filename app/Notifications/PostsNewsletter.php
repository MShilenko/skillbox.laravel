<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostsNewsletter extends Notification
{
    use Queueable;

    public $posts;
    public $start;
    public $end;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($posts, string $start, string $end)
    {
        $this->posts = $posts;
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())->markdown('mail.posts-subscribe', ['posts' => $this->posts, 'start' => $this->start, 'end' => $this->end])->subject('Рассылка статей');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
