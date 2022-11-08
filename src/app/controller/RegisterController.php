<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;


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
    function postRegister(){
        $url = Url::BaseApi()."/api/penyedia/register/akun";
    }
}
