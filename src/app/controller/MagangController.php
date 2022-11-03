<?php


namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class MagangController
{

    function search_magang()
    {
        
        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern"
        ];

        View::render("/magang/search_magang", $model, "getFooter");
        View::redirect("");
    }

    function detailMagang()
    {
        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern"
        ];

        View::render("/magang/detail_magang", $model, "getFooter");
        View::redirect("");
    }
    function hasil_cari()
    {
        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern"
        ];

        View::render("/magang/hasil_cari", $model, "getFooter");
        View::redirect("");
    }
}
