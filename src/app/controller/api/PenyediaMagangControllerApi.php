<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\dto\AktivasiAkunRequest;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\RegisterPenyediaRequest;
use LearnPhpMvc\service\PenyediaMagangService;

class PenyediaMagangControllerApi
{

    private PenyediaMagangService $service;
    public function __construct()
    {
        $this->service = new PenyediaMagangService();
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
    public function sendEmail()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $path_info  = $_SERVER['PATH_INFO'];
        $listOfUrl = explode("/", $path_info);
        $usernameAkunVerivication = $listOfUrl[4];
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $request = new AktivasiAkunRequest();
        $byUsername = $this->service->findByUsername($usernameAkunVerivication);
        if ($byUsername['status'] != "oke") {
            echo "akun tidak tersedia";
        } else {
            $request->setEmail($byUsername[0]['email']);
            $arr = $this->service->sendMailVerivikasi($request);
            echo json_encode($arr);
        }        //        echo $_GET['']
    }
    public function verivikasiAkun()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $path = $_SERVER['PATH_INFO'];
        $result = explode($path, "/");
        $aktifasi = new AktivasiAkunRequest();
        $arr = $this->service->updateStatusUser();
        echo json_encode($arr);
    }
    public function regristasiAkun()
    {
        
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $request = new RegisterPenyediaRequest();
        $request->setUsername($jsonData['username']);
        $request->setPassword(password_hash($jsonData['password'], PASSWORD_BCRYPT));
        $request->setEmail($jsonData['email']);
        $request->setNo_telp($jsonData['no_telp']);
        $request->setRole($jsonData['role']);
        $request->setToken($jsonData['token']);
        $request->setNama_perusahaan($jsonData['nama_perusahaan']);
        $request->setAlamat($jsonData['alamat']);
        $responseRegister = $this->service->register($request);
        echo json_encode($responseRegister);
    }

    // public function register()
    // {
    //     http_response_code(200);
    //     header("Access-Control-Allow-Origin: *");
    //     header("Content-Type: application/json; charset=UTF-8");
    //     header("Access-Control-Allow-Methods: POST");
    //     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    //     $jsonData = json_decode(file_get_contents("php://input"), true);
    //     $request = new RegisterPenyediaRequest();
    //     $request->setUsername($jsonData['username']);
    //     $request->setPassword(password_hash($jsonData['password'], PASSWORD_BCRYPT));
    //     $request->setEmail($jsonData['email']);
    //     $request->setNo_telp($jsonData['no_telp']);
    //     $request->setRole($jsonData['role']);
    //     $request->setToken($jsonData['token']);
    //     $request->setAlamat($jsonData['alamat']);
    //     $responseRegister = $this->service->register($request);
    //     echo json_encode($responseRegister);
    // }

    public function login()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $loginRequest = new LoginRequest();
        $loginRequest->username = $jsonData['username'];
        $loginRequest->password = $jsonData['password'];
        $responseLogin = $this->service->login($loginRequest);
        echo json_encode($responseLogin);
    }
}
