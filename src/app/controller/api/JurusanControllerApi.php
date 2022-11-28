<?php


namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\repository\JurusanRepository;
use LearnPhpMvc\service\JurusanService;

class JurusanControllerApi
{


    private JurusanService $service;


    public function __construct()
    {
        $repository = new JurusanRepository(Database::getConnection());
        $this->service = new JurusanService($repository);
    }

    public function findAll()
    {
        $response = $this->service->findAll();
        echo json_encode($response);
    }

    public function findById()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $id = $jsonData['id'];
        $response = $this->service->findById($id);
        echo json_encode($response);
    }

    public function findByJurusan()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $jurusan = $jsonData['jurusan'];
        $response =  $this->service->findByJurusan($jurusan);
        echo json_encode($response);
    }
}
