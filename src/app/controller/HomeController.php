<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Session\MySession;

class HomeController
{
    function index()
    {
        $model = [
            'title' => "Belajar php mvc",
            'content' => "Go Intern"
        ];
        $isLogin = MySession::getCurrentSession();
        if($isLogin['status'] ==true){
            $model = [
                'title' => "Isi Data Lamaran",
                'content' => "Go Intern" , 
                'result' => $isLogin
            ];
            View::render("/penyedia/index", $model, "getFooter2");
            View::redirect("/home/index");
        }else{
            View::render("/home/index", $model, "getFooter2");
        }
    }
}
