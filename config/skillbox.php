<?php

return [
    'my_email' => env('SKILLBOX_MY_EMAIL'),
    'my_password' => env('SKILLBOX_MY_PASSWORD'),
    'pushall' => [
        'id' => env('SKILLBOX_PUSHALL_ID'),
        'key' => env('SKILLBOX_PUSHALL_KEY'),
    ],
    'posts' => [
        'paginate' => 10,
    ],
    'cache' => [
        'time' => 3600
    ],
];