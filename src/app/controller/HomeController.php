<?php

    namespace LearnPhpMvc\controller;
    

    class HomeController{
        
        function index(){
            $model=[
                'title'=>"Belajar php mvc",
                'content'=>"Beleajar php mvc content"
            ];
            

            require __DIR__.'../../view/home/index.php';
        }
        
    
    }

?>