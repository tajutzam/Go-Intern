<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;


class RegisterController
{

    function formRegister()
    {
        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern"
        ];

        View::render("/auth/register/register_form", $model, "getFooter3");
        View::redirect("");
    }
}
