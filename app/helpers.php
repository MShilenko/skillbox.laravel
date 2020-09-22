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
