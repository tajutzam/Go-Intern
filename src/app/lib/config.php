<?php

namespace LearnPhpMvc\lib;

class ConfigShow
{
    public function getFooter()
    {
        require __DIR__ . "/../view/components/footer2.php";
    }



    public function noFunction()
    {
    }

    public function getFooter2()
    {
        require __DIR__ . "/../view/components/footer3.php";
    }
    public function getFooter3()
    {
        require __DIR__ . "/../view/components/footer_register.php";
    }
}
