<?php


namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class PenyediaMagangController
{

    function home()
    {
        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern"
        ];

        View::render("/penyedia/index", $model, "getFooter3");
        View::redirect("");
    }
}
