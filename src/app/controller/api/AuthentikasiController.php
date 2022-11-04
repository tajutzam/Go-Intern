<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\dto\AktivasiAkunRequest;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\RegisterPencariMagangRequest;
use LearnPhpMvc\repository\PencariMagangRepository;
use LearnPhpMvc\service\PencariMagangService;

class AuthentikasiController
{
    private PencariMagangService $service;

    public function __construct()
    {
        $repository = new PencariMagangRepository(Database::getConnection());
        $this->service = new PencariMagangService($repository);
    }


    public function login() : array{
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
    public function register() : array{
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $request = new RegisterPencariMagangRequest();
        $request->setUsername($jsonData['username']);
        $request->setPassword($jsonData['password']);
        $request->setNamaDepan($jsonData['nama_depan']);
        $request->setNamaBelakang($jsonData['nama_belakang']);
        $request->setSkill($jsonData['skill']);
        $request->setNotelp($jsonData['notelp']);
        $request->setAlamat($jsonData['alamat']);
        $request->setAgama($jsonData['agama']);
        $request->setCv($jsonData['cv']);
        $request->setResume($jsonData['resume']);
        $request->setFoto($jsonData['foto']);
        $request->setRole($jsonData['role']);
        $request->setIdSekolah($jsonData['id_sekolah']);
        $request->setEmail($jsonData['email']);
        $request->setToken($jsonData['token']);
        $arr = $this->service->register($request);
        echo json_encode($arr);
        return $arr;
    }

    public function registerMobile(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $request = new RegisterPencariMagangRequest();

        $request->setIdSekolah($jsonData['id_sekolah']);
        $request->setUsername($jsonData['username']);
        $request->setPassword($jsonData['passsword']);
        $request->setEmail($jsonData['email']);
        $request->setToken($jsonData['token']);
        $request->setTanggalLahir($jsonData['tanggal_lahir']);
        $request->setRole($jsonData['role']);
        $request->setNamaDepan($jsonData['nama_depan']);
        $request->setNamaBelakang($jsonData['nama_belakang']);
        $arr = $this->service->registerMobile($request);
        echo json_encode($arr);
    }
    public function sendEmail() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $path_info  = $_SERVER['PATH_INFO'];
        $listOfUrl = explode("/" , $path_info);
        $usernameAkunVerivication = $listOfUrl[3];
        var_dump($usernameAkunVerivication);
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $request = new AktivasiAkunRequest();
        $byUsername = $this->service->findByUsername($usernameAkunVerivication);
        if($byUsername['status']!="oke"){
            echo "akun tidak tersedia";
        }else{
            $request->setEmail($byUsername['body'][0]['email']);
            $arr = $this->service->sendMailVerivikasi($request);
            echo json_encode($arr);
        }
//        echo $_GET['']
    }
    public function verivikasiAkun(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $arr = $this->service->verivikasiAkun();
        echo json_encode($arr);
    }
}