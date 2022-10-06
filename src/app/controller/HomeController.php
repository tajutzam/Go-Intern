<?php

    namespace LearnPhpMvc\controller;
    

    use LearnPhpMvc\APP\View;

    class HomeController{
        
        function index(){
            $model=[
                'title'=>"Belajar php mvc",
                'content'=>"Beleajar php mvc content"
            ];

            View::render("/home/index" , $model);
        }
        
    
    }

?>