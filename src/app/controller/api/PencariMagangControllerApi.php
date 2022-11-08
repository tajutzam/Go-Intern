<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\SearchKeyword;
use LearnPhpMvc\dto\UpdatePencariMagangRequest;
use LearnPhpMvc\repository\PencariMagangRepository;
use LearnPhpMvc\service\PencariMagangService;

class PencariMagangControllerApi
{
    public PencariMagangService $service;

    /**
     * @param PencariMagangService $service
     */
    public function __construct()
    {
        $repository = new PencariMagangRepository(Database::getConnection());
        $this->service = new PencariMagangService($repository);
    }


    function findAll(): void
    {
        //get dari database dan masukan kedalam array , gunakan fetch_assoc
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $all = $this->service->findAll();
        $data = array();
        $data['body'] = $all;
        if ($all['status'] == 'oke') {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        echo json_encode($data);
    }

    function findByUsername(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $jsonEncoded = $this->service->findByUsername($jsonData['username']);
        echo json_encode($jsonEncoded);
    }

    function findByUsernameLike(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $keyword = new SearchKeyword();
        $keyword->setKeyword($jsonData['username']);
        $jsonEncoded = $this->service->findByUsernameLike($keyword);
        echo json_encode($jsonEncoded);
    }

    function updatePencariMagang(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $request = new UpdatePencariMagangRequest();
        $request->setUsername($jsonData['username']);
        $passwordHash = password_hash($jsonData['password'] , PASSWORD_BCRYPT);
        $request->setPassword($passwordHash);
        $request->setFoto($jsonData['foto']);
        $request->setNama($jsonData['nama']);
        $request->setId_sekolah($jsonData['id-sekolah']);
        $request->setNo_telp($jsonData['no_telp']);
        $request->setResume($jsonData['resume']);
        $request->setId($jsonData['id']);
        $request->setCv($jsonData['cv']);
        $request->setTanggalLahir($jsonData['tanggal_lahir']);
        $request->setAgama($jsonData['agama']);
        $request->setEmail($jsonData['email']);
        $updateData = $this->service->updateData($request);
        echo json_encode($updateData);
    }

    public function findByStatusAktif() {
        $byStatusAktif = $this->service->findByStatusAktif();
        echo json_encode($byStatusAktif);
    }

}
