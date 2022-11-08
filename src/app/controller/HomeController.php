<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

class HomeController
{
    function index()
    {
        $model = [
            'title' => "Belajar php mvc",
            'content' => "Go Intern"
        ];
//
        View::render("/home/index", $model, "getFooter3");
    }
}
