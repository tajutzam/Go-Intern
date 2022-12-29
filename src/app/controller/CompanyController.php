<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class CompanyController
{
    function index()
    {
        $model = [
            'title' => "Belajar php mvc",
            'content' => "Go Intern"
        ];
        View::render("/company/index", $model, "getFooter");
    }
    function detailCompany()
    {
        $model = [
            'title' => "Belajar php mvc",
            'content' => "Go Intern"
        ];
        View::render("/company/detail_company", $model, "getFooter");
    }
}
