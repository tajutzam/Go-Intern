<?php

namespace LearnPhpMvc\Config;

class Url
{
    static function BaseUrl(): string
    {
        $url = "http://localhost:8081";
        return $url;
    }

    static function BaseApi() : string{
         $url = "http://192.168.0.9:8080";
        // $url = "http//localhost:8080";
        return $url;
    }
}
