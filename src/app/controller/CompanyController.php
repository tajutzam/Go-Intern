<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class CompanyController
{
    public function search(): void
    {
        $model=[
            'title'=>"Belajar php mvc",
            'content'=>"Go Intern"
        ];


        View::render("company/company_search" , $model);
        View::redirect("");
    }
    public function bestCompany(): void
    {
        $model=[
            'title'=>"Belajar php mvc",
            'content'=>"Go Intern"
        ];


        View::render("company/index" , $model);
        View::redirect("");
    }
}