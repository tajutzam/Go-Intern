<?php

namespace LearnPhpMvc\Config;

class Url
{
    static function BaseUrl(): string
    {
        // ngrok url
        $url = "http://192.168.0.11:8081";
        return $url;
    }
    static function BaseApi() : string{
        // ngrok api
        $url = "http://192.168.0.11:8080";
        // $url = "http//localhost:8080";
        return $url;
    }

    static function domain()
    {
        return "192.168.0.11";
    }
}
