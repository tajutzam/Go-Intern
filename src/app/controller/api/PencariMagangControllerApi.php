<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\SearchKeyword;
use LearnPhpMvc\dto\UpdatePencariMagangRequest;
use LearnPhpMvc\repository\PencariMagangRepository;
use LearnPhpMvc\repository\SkillRepository;
use LearnPhpMvc\service\LowonganMagangService;
use LearnPhpMvc\service\PencariMagangService;

class PencariMagangControllerApi
{
    public PencariMagangService $service;

    private LowonganMagangService $serviceLowonganMagang;

    /**
     * @param PencariMagangService $service
     */
    public function __construct()
    {
        $repository = new PencariMagangRepository(Database::getConnection());
        $skillrepo = new SkillRepository(Database::getConnection());
        $this->service = new PencariMagangService($repository, $skillrepo);
        $this->serviceLowonganMagang = new LowonganMagangService();
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

    function findByUsername()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $jsonEncoded = $this->service->findByUsername($jsonData['username']);
        echo json_encode($jsonEncoded);
    }

    function findByUsernameLike()
    {
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

    function updatePencariMagang()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $request = new UpdatePencariMagangRequest();
        $request->setUsername($jsonData['username']);
        $passwordHash = password_hash($jsonData['password'], PASSWORD_BCRYPT);
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

    public function updateTentangSaya()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $tentang_saya = $jsonData['tentang-saya'];
        $id = $jsonData['id'];
        $response = $this->service->updateTentangSaya($tentang_saya, $id);
        echo json_encode($response);
    }
    public function findByStatusAktif()
    {
        $byStatusAktif = $this->service->findByStatusAktif();
        echo json_encode($byStatusAktif);
    }

    public function uploadImage()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $id = $_POST['username'];
        $array = $this->service->uploadImage($id);
        echo json_encode($array);
    }

    public function findById()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $id = $jsonData['id'];
        $response = $this->service->findByIdApi($id);
        echo json_encode($response);
    }

    public function updateDataSekolah()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $sekolah = $jsonData['sekolah'];
        $jurusan = $jsonData['jurusan'];
        $id = $jsonData['id'];
        $response = $this->service->addSekolah($sekolah, $jurusan, $id);
        echo json_encode($response);
    }

    public function showDataSekolah()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $id = $jsonData['id'];
        $response = $this->service->showdatasekolah($id);
        echo json_encode($response);
    }

    public function uploadPenghargaan()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $response =    $this->service->addPenghargaan($_FILES['penghargaan'], $_POST['judul'], $_POST['username']);
        echo json_encode($response);
    }

    public function updateDeskripsi()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $deskripsi = $jsonData['deskripsi'];
        $id = $jsonData['id'];
        $response =  $this->service->updateDeskripsi($deskripsi, $id);
        echo json_encode($response);
    }

    public function updateDataPersonal()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $nama = $jsonData['nama'];
        $email = $jsonData['email'];
        $tanggal_lahir = $jsonData['tanggal_lahir'];
        $agama = $jsonData['agama'];
        $jenis_kelamin = $jsonData['jenis_kelamin'];
        $id = $jsonData['id'];
        $response = $this->service->updateDataPersonal($nama, $email, $tanggal_lahir, $agama, $jenis_kelamin, $id);
        echo json_encode($response);
    }

    public function upadateKemananUser()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $username = $jsonData['username'];
        $password = $jsonData['password'];
        $id = $jsonData['id'];
        $response =  $this->service->updateKeamann($username, $password, $id);
        echo json_encode($response);
    }
    public function updateCv()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $username = $_POST['username'];
        $array = $this->service->updateCv($_FILES['cv'], $username);
        echo json_encode($array);
    }

    public function updateNoTelp()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $noTelp = $jsonData['no_telp'];
        $id = $jsonData['id'];
        $response = $this->service->updateNoHp($noTelp, $id);
        echo json_encode($response);
    }

    public function showMagangActive()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $id = $jsonData['id'];
        $response = $this->service->showMagangActive($id);
        echo json_encode($response);
    }

    public function showRiwayatLamran()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $id = $jsonData['id'];
        $response = $this->service->showRiwayatlamaran($id);
        echo json_encode($response);
    }

    public function batalkanLamaran()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $idMagang = $jsonData['idMagang'];
        $idPencari = $jsonData['idPencari'];
        $response = $this->serviceLowonganMagang->batalkanLamaran($idMagang, $idPencari);
        echo json_encode($response);
    }
}
