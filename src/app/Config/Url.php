<?php

namespace LearnPhpMvc\Config;

class Url
{
    static function BaseUrl(): string
    {
        // ngrok url
        $url = "http://143.198.198.61";
        return $url;
    }
    static function BaseApi() : string{
        // ngrok api
        $url = "http://143.198.198.61";
        // $url = "http//localhost:8080";
        return $url;
    }

    static function domain()
    {
        return "143.198.198.61";
    }
}
