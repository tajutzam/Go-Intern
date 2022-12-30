<?php

namespace LearnPhpMvc\controller\api;
use LearnPhpMvc\service\PencariMagangService;
use LearnPhpMvc\service\SekolahService;

class TestController{


    private SekolahService $service;


    function __construct()
    {
        $this->service = new SekolahService();
    }

    function index(){
        echo "adsa";
    }
}