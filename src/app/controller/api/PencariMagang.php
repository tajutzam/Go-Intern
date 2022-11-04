<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\repository\PencariMagangRepository;
use LearnPhpMvc\service\PencariMagangService;

class PencariMagang
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
        $all = $this->service->findAll();
        $data = array();
        $data['body'] = $all;
        if ($all['body']['status'] == 'oke') {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        echo json_encode($data);
    }

    public function login(): array
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $loginRe = new LoginRequest();
        $loginRe->username = $jsonData['username'];
        $loginRe->password = $jsonData['password'];
        $arr = $this->service->login($loginRe);
        echo json_encode($arr);
        return $arr;
    }
}
