<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class Pushall
{
    private $id;
    private $apiKey;
    private $url = 'https://pushall.ru/api.php';

    public function __construct(string $id, string $apiKey)
    {
        $this->id = $id;
        $this->apiKey = $apiKey;
    }

    public function send(string $title, string $text)
    {
        $data = [
            "type" => "self",
            "id" => $this->id,
            "key" => $this->apiKey,
            "title" => $title,
            "text" => $text,
        ];

        return Http::asForm()->post($this->url, $data);
    }
}
