<?php

namespace LearnPhpMvc\Config;

class Url
{
    static function BaseUrl(): string
    {
        // ngrok url
        $url = "http://localhost:8081";
        return $url;
    }
    static function BaseApi() : string{
        // ngrok api
        $url = "http://localhost:8080";
        // $url = "http//localhost:8080";
        return $url;
    }

    static function domain(){
        return "localhost";
    }
}
