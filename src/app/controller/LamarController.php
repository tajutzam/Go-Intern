<?php


namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\lib\ConfigShow;

class LamarController
{


    function formLamar()
    {
        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern"
        ];

        View::render("/lamar/form_lamar", $model, "noFunction");
        View::redirect("");
    }
}
