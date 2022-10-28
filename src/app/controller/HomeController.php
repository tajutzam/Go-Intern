<?php

    namespace LearnPhpMvc\controller;

    use LearnPhpMvc\APP\View;

    class HomeController{
        function index(){
            $model=[
                'title'=>"Belajar php mvc",
                'content'=>"Go Intern"
            ];
            
            View::render("/home/index" , $model,"getFooter3");
        }
    }
