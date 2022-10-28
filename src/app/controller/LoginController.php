<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class LoginController
{

    function formLogin()
    {
        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern"
        ];

        View::render("/auth/login/login_form", $model, "getFooter2");
        View::redirect("");
    }
}
