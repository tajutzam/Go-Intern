<?php


namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\service\KategoriService;

class KategoriControllerApi{


    private KategoriService $service;

    public function __construct()
    {
        $this->service = new KategoriService();
    }

    
    public function findAll(){
        $data =  $this->service->findAll();
        echo json_encode($data);
    }
}