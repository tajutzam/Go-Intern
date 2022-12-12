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

    public function findAll()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $jenis = $jsonData['jenis'];
        $arr = $this->service->findAll($jenis);
        echo json_encode($arr);
    }

    public function findById()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            $urlTemp = $_SERVER['PATH_INFO'];
            $arrayTemp = explode("/", $urlTemp);
            $id = $arrayTemp[4];
            $response =  $this->service->findById($id);
            echo json_encode($response);
        }
    }
}
