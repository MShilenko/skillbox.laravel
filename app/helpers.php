<?php

if (!function_exists('flash')){
    /**
     * Add a message and its type to the session
     * @param  string $messsage
     * @param  string $type
     * @return void
     */
    function flash(string $message, string $type = 'success'): void
    {
        session()->flash('message', $message);
        session()->flash('type', $type);
    }
}

if (!function_exists('push_all')) {
    /**
     * Pushall service message send
     * @param  string|null $title
     * @param  string|null $text
     * @return mixed
     */
    function push_all(string $title = null, string $text = null)
    {
        if (is_null($title) || is_null($text)) {
            return app(\App\Service\Pushall::class);
        }

        return app(\App\Service\Pushall::class)->send($title, $text);
    }      
}
