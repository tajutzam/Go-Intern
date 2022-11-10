<?php


namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Session\MySession;

class PenyediaMagangController
{
    static function home()
    {
        $isLogin = MySession::getCurrentSession();
        if($isLogin['status'] != false){
            $model = [
                'title' => "Isi Data Lamaran",
                'content' => "Go Intern" , 
                'result' => $isLogin
            ];
            View::render("/penyedia/index", $model, "getFooter3");
            View::redirect("/home/index");
        }else{
            LoginController::formLogin();
        }
    }
}
