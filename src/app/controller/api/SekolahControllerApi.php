<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Domain\Sekolah;
use LearnPhpMvc\service\SekolahService;

class SekolahControllerApi
{


    private SekolahService $sekolahservice;

    public function __construct()
    {
        $this->sekolahservice = new SekolahService();
    }

    public function findAll()
    {
        $response = $this->sekolahservice->findAll();
        echo json_encode($response);
    }

    public function save()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $sekolah = new Sekolah();
        $sekolah->sekolah = $jsonData['sekolah'];
        $response =  $this->sekolahservice->insertSekolah($sekolah);

        echo json_encode($response);
    }

    public function addJurusanToSekolah()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $sekolah = $jsonData['sekolah'];
        $jurusan = $jsonData['jurusan'];
        $response = $this->sekolahservice->addJurusan($sekolah, $jurusan);
        echo json_encode($response);
    }

    public function findBySekolah()
    {
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $sekolah = $jsonData['sekolah'];
        $response =  $this->sekolahservice->findBySekolah($sekolah);
        echo json_encode($response);
    }
}
