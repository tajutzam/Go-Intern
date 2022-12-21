<?php

namespace LearnPhpMvc\controller\admin;


use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Sekolah;
use LearnPhpMvc\helper\Helper as HelperHelper;
use LearnPhpMvc\helper\Helper;
use LearnPhpMvc\repository\JurusanRepository;
use LearnPhpMvc\repository\PencariMagangRepository;
use LearnPhpMvc\repository\SkillRepository;
use LearnPhpMvc\service\AdminService;

use LearnPhpMvc\service\JenisUsahaService;
use LearnPhpMvc\service\JurusanService;
use LearnPhpMvc\service\PencariMagangService;
use LearnPhpMvc\service\PenyediaMagangService;
use LearnPhpMvc\service\SekolahService;
use LearnPhpMvc\Session\MySession;
use PHPUnit\TextUI\Help;

class AdminController
{


    private PenyediaMagangService $service;
    private SekolahService $sekolahService;

    private JurusanService $jurusanService;
    private JenisUsahaService $jenisUsahaService;

    private AdminService $adminService;

    private PencariMagangService $pencariService;



    function __construct()
    {
        $this->sekolahService = new SekolahService();
        $this->service = new PenyediaMagangService();
        $repositoryJurusan = new JurusanRepository(Database::getConnection());
        $this->jurusanService = new JurusanService($repositoryJurusan);
        $this->jenisUsahaService = new JenisUsahaService();
        $this->adminService = new AdminService();
        $repositoryPencari = new PencariMagangRepository(Database::getConnection());
        $skillRepo = new SkillRepository(Database::getConnection());
        $this->pencariService = new PencariMagangService($repositoryPencari, $skillRepo);
    }
    function home()
    {
        $isLogin = MySession::adminSession();
        if ($isLogin['isLogin'] ==  true) {
            $jumlahPencari = $this->adminService->countPencariMagang();
            $model = [
                'title' => "Belajar php mvc",
                'content' => "Go Intern",
                "nama" => $isLogin['nama'] , 
                "jmlPencari" => $jumlahPencari['jumlah'] , 
                
            ];
            View::renderAdmin("index", $model);
        } else {
            $model = [
                'title' => "ADMIN || LOGIN",
                'content' => "Go Intern"
            ];
            View::renderAdminLogin("login", $model);
        }
    }

    function login()
    {
        $isLogin = MySession::adminSession();
        if ($isLogin['isLogin'] == true) {
            $model = [
                'title' => "ADMIN || HOME DASHBOARD",
                'content' => "Go Intern",
                "nama" => $isLogin['nama']
            ];
            View::renderAdmin("index", $model);
        } else {
            $model = [
                'title' => "ADMIN || LOGIN",
                'content' => "Go Intern"
            ];
            View::renderAdminLogin("login", $model);
        }
    }

    function register()
    {
        $session = MySession::adminSession();
        if ($session['isLogin'] == true) {
            $model = [
                'title' => "ADMIN || HOME DASHBOARD",
                'content' => "Go Intern",
                "nama" => $session['nama']
            ];

            View::renderAdmin("index", $model);
        } else {
            $model = [
                'title' => "ADMIN || REGISTER",
                "content" => "Register page"
            ];
            View::renderAdminLogin("register", $model);
        }
    }

    function postRegister()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['nama'];
        $konfirmasiPassword = $_POST['konfirmasiPassword'];
        if ($password != $konfirmasiPassword) {
            Helper::showMessage("Password dan konfirmasi password tidak sama", "/admin/register");
        } else {
            $response = $this->adminService->register($username, $password, $name);
            if ($response['status'] == "oke") {
                Helper::showMessage($response['message'], "/admin/login");
            } else {
                Helper::showMessage($response['message'], "/admin/register");
            }
        }
    }

    function postLogin()
    {
        $model = [
            "title" => "ADMIN || LOGIN"
        ];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $btn = $_POST['login'];
        if (isset($btn)) {
            $response =  $this->adminService->login($username, $password);
            if ($response['status'] == 'oke') {
                Helper::showMessage($response['message'], "/admin/home");
            } else {
                Helper::showMessage($response['message'], "/admin/login");
            }
        } else {
            View::renderAdminLogin("login", $model);
        }
    }

    // close admin

    function kategori()
    {
        $session = MySession::adminSession();
        if ($session['isLogin'] == false) {
            $model = [
                "title" => "ADMIN || LOGIN",
                "content" => "Login Page"
            ];
            View::renderAdminLogin("login", $model);
        } else {
            $model = [
                'title' => "ADMIN || KATEGORI",
                "content" => "KATEGORI PAGE"
            ];
            View::renderAdmin("kategori", $model);
        }
    }

    function addKategori()
    {
        $kategori = $_POST['kategori'];
        echo $kategori;
    }

    function penyedia()
    {
        $responsePenyedia = $this->service->findAll();

        $session = MySession::adminSession();
        if ($session['isLogin'] == true) {
            $model = [
                'title' => "penyedia",
                "content" => "Penyedia",
                "data" => $responsePenyedia
            ];
            View::renderAdmin("penyedia", $model);
        } else {
            $model = [
                'title' => "ADMIN || LOGIN",
                "content" => "ADMIN || LOGIN PAGE"
            ];
            View::renderAdminLogin("login", $model);
        }
    }


    function enablePenyedia($id)
    {
        $path = $_SERVER['PATH_INFO'];
        $exploded = explode("/", $path);
        // admin/pencarimagang/enabled/id   
        $id = $exploded[4];
        $response = $this->service->enable($id);
        Helper::showMessage($response['message'], "/admin/penyedia");
    }

    function disablePenyedia($id)
    {
        $path = $_SERVER['PATH_INFO'];
        $exploded = explode("/", $path);
        // admin/pencarimagang/enabled/id   
        $id = $exploded[4];
        $response = $this->service->disable($id);
        Helper::showMessage($response['message'], "/admin/penyedia");
    }
    // sekolah
    function sekolah()
    {
        $responseDataSekolah = $this->sekolahService->findAll();
        $session = MySession::adminSession();
        if ($session['isLogin'] == true) {
            $model = [
                'title' => "penyedia",
                "content" => "Penyedia",
                "data" => $responseDataSekolah

            ];
            View::renderAdmin("sekolah", $model);
        } else {
            $model = [
                "title" => "ADMIN || LOGIN",
                "content" => "LOGIN PAGE",
            ];
            View::renderAdminLogin("login", $model);
        }
    }

    function addSekolah()
    {
        $sekolah = $_POST['sekolah'];
        $sekolahObj = new Sekolah();
        $sekolahObj->sekolah = $sekolah;
        $response = $this->sekolahService->insertSekolah($sekolahObj);
        Helper::showMessage($response['message'], "/admin/sekolah");
    }
    function updateSekolah()
    {
        $sekolah = $_POST['sekolah'];
        $id = $_POST['id'];
        $response = $this->sekolahService->update($sekolah, $id);
        Helper::showMessage($response['message'], "/admin/sekolah");
    }

    function deleteSekolah()
    {
        $path = $_SERVER['PATH_INFO'];
        $exploded = explode("/", $path);
        $id = $exploded[4];
        $response = $this->sekolahService->delete($id);
        Helper::showMessage($response['message'], "/admin/sekolah");
    }
    //close sekolah
    // jurusan
    function jurusan()
    {
        $responseJurusan = $this->jurusanService->findAll();
        $session = MySession::adminSession();
        if ($session['isLogin'] == true) {
            $model = [
                'title' => "penyedia",
                "content" => "Penyedia",
                "data" => $responseJurusan

            ];
            View::renderAdmin("jurusan", $model);
        } else {
            $model = [
                'title' => "ADMIN || LOGIN",
                "content" => "ADMIN LOGIN PAGE",

            ];
            View::renderAdminLogin("login", $model);
        }
    }
    function addJurusan()
    {
        $jurusan = $_POST['jurusan'];
        if (isset($jurusan)) {
            $response = $this->jurusanService->save($jurusan);
            Helper::showMessage($response['message'], "/admin/jurusan");
        } else {
            Helper::showMessage("Gagal menambahkan jurusan harap isi jurusan terlebih dahulu", "/admin/jurusan");
        }
    }
    function updateJurusan()
    {
        $jurusan = $_POST['updateJurusan'];
        $id = $_POST['id'];
        $response = $this->jurusanService->updateJurusan($jurusan, $id);
        Helper::showMessage($response['message'], "/admin/jurusan");
    }
    function deleteJurusan()
    {
        $path = $_SERVER['PATH_INFO'];
        $exploded = explode("/", $path);
        $id = $exploded[4];
        $response = $this->jurusanService->delete($id);
        Helper::showMessage($response['message'], "/admin/jurusan");
    }
    // close jurusan

    // jenis usaha

    function jenisUsaha()
    {
        $session = MySession::adminSession();
        if ($session['isLogin'] == false) {
            $model = [
                "title" => "ADMIN || LOGIN",
                "content" => "ADMIN LOGIN PAGE"
            ];
            View::renderAdminLogin("login", $model);
        } else {
            $responseModel = $this->jenisUsahaService->showAll();
            $model = [
                "title" => "ADMIN || JENIS USAHA",
                "content" => "jenis usaha",
                "data" => $responseModel
            ];
            View::renderAdmin("jenisusaha", $model);
        }
    }

    function addJenisUsaha()
    {
        $jenis = $_POST['jenis'];
        $response = $this->jenisUsahaService->addJenis($jenis);
        Helper::showMessage($response['message'], "/admin/jenisusaha");
    }

    function updateJenisUsaha()
    {
        $jenis = $_POST['jenis'];
        $id = $_POST['id'];
        $response = $this->jenisUsahaService->update($jenis, $id);
        Helper::showMessage($response['message'], "/admin/jenisusaha");
    }

    function deleteJenisUsaha()
    {
        $path = $_SERVER['PATH_INFO'];
        $exploded = explode("/", $path);
        $id = $exploded[4];
        $response = $this->jenisUsahaService->deleteJenis($id);
        Helper::showMessage($response['message'], "/admin/jenisusaha");
    }


    // close jenis usaha

    //pencarimagang
    function pencariMagang()
    {
        $response = $this->pencariService->findAll();
        $model = [
            "title" => "ADMIN || PENCARI MAGANG",
            "content" => "ADMIN , PENCARI MAGANG PAGE",
            "data" => $response
        ];
        View::renderAdmin("pencarimagang", $model);
    }
    //close pencari

    public function enablePencariMagang()
    {
        $path = $_SERVER['PATH_INFO'];
        $exploded = explode("/", $path);
        // admin/pencarimagang/enabled/id   
        $id = $exploded[4];
        $response = $this->pencariService->enable($id);
        Helper::showMessage($response['message'], "/admin/pencarimagang");
    }
    public function disablePencariMagang()
    {
        $path = $_SERVER['PATH_INFO'];
        $exploded = explode("/", $path);
        $id = $exploded[4];
        $response = $this->pencariService->disable($id);
        Helper::showMessage($response['message'], "/admin/pencarimagang");
    }


    // admin api
    function getUserRegristations(){
        $response = $this->adminService->getUsersRegristations();
        echo json_encode($response);
    }

    function getCompanRegristations(){
        $response = $this->adminService->getCompanyRegristation();
        echo json_encode($response);
    }
}
