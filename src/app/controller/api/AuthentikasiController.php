<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Database;
use LearnPhpMvc\dto\AktivasiAkunRequest;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\RegisterPencariMagangRequest;
use LearnPhpMvc\repository\PencariMagangRepository;
use LearnPhpMvc\repository\SkillRepository;
use LearnPhpMvc\service\PencariMagangService;

class AuthentikasiController
{
    private PencariMagangService $service;

    public function __construct()
    {
        $repository = new PencariMagangRepository(Database::getConnection());
        $skillRepository = new SkillRepository(Database::getConnection());
        $this->service = new PencariMagangService($repository, $skillRepository);
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
    public function register(): array
    {
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
        $request->setJenis_kelamin($jsonData['jenis_kelamin']);
        //        $request->setIdSekolah($jsonData['id_sekolah']);
        $request->setEmail($jsonData['email']);
        $token =  substr(sha1(time()), 0, 5);
        $request->setToken($jsonData['token']);
        $arr = $this->service->register($request);
        echo json_encode($arr);
        return $arr;
    }

    public function registerMobile()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $request = new RegisterPencariMagangRequest();
        $request->setUsername($jsonData['username']);
        $request->setPassword($jsonData['passsword']);
        $request->setEmail($jsonData['email']);
        $token =  substr(sha1(time()), 0, 20);
        $request->setToken($token);
        $request->setTanggalLahir($jsonData['tanggal_lahir']);
        $request->setRole($jsonData['role']);
        $request->setNamaDepan($jsonData['nama_depan']);
        $request->setNamaBelakang($jsonData['nama_belakang']);
        $request->setJenis_kelamin($jsonData['jenis_kelamin']);
        $arr = $this->service->registerMobile($request);


        echo json_encode($arr);
    }
    public function sendEmail()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $path_info  = $_SERVER['PATH_INFO'];
        $listOfUrl = explode("/", $path_info);
        $usernameAkunVerivication = $listOfUrl[3];
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $request = new AktivasiAkunRequest();
        $byUsername = $this->service->findByUsername($usernameAkunVerivication);
        if ($byUsername['status'] != "oke") {
            echo "akun tidak tersedia";
        } else {
            $request->setEmail($byUsername['body'][0]['email']);
            $arr = $this->service->sendMailVerivikasi($request);
            echo json_encode($arr);
        }        //        echo $_GET['']
    }
    public function verivikasiAkun()
    {
        $arr = $this->service->verivikasiAkun();
        $model = [
            'title' => "succes",
            "content" => $arr['message']
        ];
        View::renderAdminLogin("succes", $model);
 }
}
