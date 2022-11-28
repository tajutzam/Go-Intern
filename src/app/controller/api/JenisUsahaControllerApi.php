<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Domain\JenisUsaha;
use LearnPhpMvc\service\JenisUsahaService;

class JenisUsahaControllerApi
{

    private JenisUsahaService $service;

    /**
     * @param JenisUsahaService $service
     */
    public function __construct()
    {
        $this->service = new JenisUsahaService();
    }

    public function findAll() {
        $arr = $this->service->findAll();
        
        echo json_encode($arr);
    }

    public function findById(){
        if(isset($_SERVER['PATH_INFO'])){
         $urlTemp = $_SERVER['PATH_INFO'];
         $arrayTemp = explode("/" , $urlTemp);
         var_dump($urlTemp);
         $id = $arrayTemp[4];
         $jenis = new JenisUsaha();
         $jenis->setId($id);
        $response =  $this->service->findById($jenis);   
        echo json_encode($response);
        }
    }

}