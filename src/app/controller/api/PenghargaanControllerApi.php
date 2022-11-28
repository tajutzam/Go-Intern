<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\service\PenghargaanService;

class PenghargaanControllerApi{


    private PenghargaanService $service;


    public function __construct()
    {
        $this->service = new PenghargaanService();
    }

    public function findById(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $id = $jsonData['id'];
        $response = $this->service->findById($id);
        echo json_encode($response);
    }

    public function findByPencariMagang(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $id = $jsonData['id'];
        $response = $this->service->findByPencariMagang($id);
        echo json_encode($response);
    }
}