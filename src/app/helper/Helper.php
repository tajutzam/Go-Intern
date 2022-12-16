<?php

namespace LearnPhpMvc\helper;
    class Helper{


        static function showMessage($message , $url){
            echo "<script>alert('" . $message . "');window.location.href='".$url."'</script>";
        }
    }

?>