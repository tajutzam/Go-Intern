<?php

namespace LearnPhpMvc\Config;

class Url
{
    static function BaseUrl(): string
    {
        $url = "http://10.10.3.98:8081";
        return $url;
    }
    static function BaseApi() : string{
        $url = "http://10.10.3.98:8080";
        // $url = "http//localhost:8080";
        return $url;
    }

    static function domain(){
        return "192.168.0.9";
    }
}
