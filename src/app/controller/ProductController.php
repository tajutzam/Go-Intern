<?php
    namespace LearnPhpMvc\controller;

    class ProductController{
        function categories(string $productid , string $categories){
            echo 'product id :'.$productid." categories :".$categories;
        }
    }
?>