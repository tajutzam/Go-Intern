<?php

namespace LearnPhpMvc\APP;

use LearnPhpMvc\lib\ConfigShow;

class View
{


    public static function render(string $view, $model)
    {
        require __DIR__ . '/../view/home/' .'header.php';
        require __DIR__ . '/../view/home/' .'style.php';
        require __DIR__ . '/../view/home/' .'navbar.php';
        require __DIR__ . '/../view/' . $view. '.php';
        require __DIR__ . '/../view/home/' .'script.php';
        require __DIR__ . '/../view/home/' . 'footer.php';
    }
    public static function redirect(string $url)
    {
        header("location:$url");
        if(getenv('mode') != 'test'){
            exit();
        }
    }


}