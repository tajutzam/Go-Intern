<?php


namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class MagangController{
    

    function search_magang(){
        $model=[
            'title'=>"Isi Data Lamaran",
            'content'=>"Go Intern"
        ];

        View::render("/magang/search_magang" , $model);
        View::redirect("");
    }

}

?>