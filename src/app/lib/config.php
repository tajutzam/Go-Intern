<?php 

namespace LearnPhpMvc\lib;

class ConfigShow{
    public function getFooter(){
        require_once __DIR__."/../view/components/footer2.php";
        return "getFooter";
    }
}

