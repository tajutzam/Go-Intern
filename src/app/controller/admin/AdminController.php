<?php

namespace LearnPhpMvc\controller\admin;

use LearnPhpMvc\APP\View;

class AdminController
{

    function home()
    {
        $model = [
            'title' => "Belajar php mvc",
            'content' => "Go Intern"
        ];

        View::renderAdmin("index", $model);
    }

    function login()
    {
        $model = [
            'title' => "Login",
            "content" => "login page"
        ];
        View::renderAdminLogin("login", $model);
    }

    function kategori()
    {
        
        $model = [
            'title' => "Login",
            "content" => "login page"
        ];
        View::renderAdmin("kategori" , $model);

    }

    function addKategori()
    {
        $kategori = $_POST['kategori'];
        echo $kategori;
    }
}
