<?php

namespace LearnPhpMvc\APP;


use LearnPhpMvc\Config\Url;
use LearnPhpMvc\lib\ConfigShow;

class View
{

    public static function render(string $view, $model, $nama_method)
    {
        require __DIR__ . "/../lib/config.php";
        $config = new ConfigShow();
        require __DIR__ . '/../view/home/' . 'header.php';
        require __DIR__ . '/../view/home/' . 'style.php';
        // require __DIR__.'/../view/admin/RuangAdmin-master/style.php';
        require __DIR__ . '/../view/home/' . 'navbar.php';
        require __DIR__ . '/../view/' . $view . '.php';
        $config->$nama_method();
        require __DIR__ . '/../view/home/' . 'script.php';
        require __DIR__ . '/../view/home/' . 'footer.php';
    }
    public static function renderDashboard(string $view, $model)
    {

        require __DIR__ . "/../../public/includes/header.php";
        require __DIR__ . "/../../public/includes/style.php";
        $model;
        require __DIR__ . "/../../public/includes/navbar.php";
        require __DIR__ . "/../view/admin/RuangAdmin-master/$view.php";
        require __DIR__ . "/../../public/includes/script.php";
        require __DIR__ . "/../../public/includes/footer.php";
    }
    public static function renderHome(string $view, $model, $nama_method)
    {
        require __DIR__ . "/../lib/config.php";
        $config = new ConfigShow();
        require __DIR__ . '/../view/home/' . 'header.php';
        require __DIR__ . '/../view/home/' . 'style.php';
        // require __DIR__.'/../view/admin/RuangAdmin-master/style.php';
        require __DIR__ . '/../view/' . $view . '.php';
        $config->$nama_method();
        require __DIR__ . '/../view/home/' . 'script.php';
        require __DIR__ . '/../view/home/' . 'footer2.php';
    }
    public static function redirect(string $url)
    {
        $url = Url::BaseUrl() . "/" . "$url";
        header('Location:' . $url);
        if (getenv('mode') != 'test') {
            exit();
        }
    }
}
