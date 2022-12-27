<?php

namespace LearnPhpMvc\controller\admin;


use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Sekolah;
use LearnPhpMvc\helper\Helper as HelperHelper;
use LearnPhpMvc\helper\Helper;
use LearnPhpMvc\helper\MoveFile;
use LearnPhpMvc\repository\JurusanRepository;
use LearnPhpMvc\repository\PencariMagangRepository;
use LearnPhpMvc\repository\SkillRepository;
use LearnPhpMvc\service\AdminService;

use LearnPhpMvc\service\JenisUsahaService;
use LearnPhpMvc\service\JurusanService;
use LearnPhpMvc\service\KategoriService;
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

    private KategoriService $kategoriService;


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
        $this->kategoriService = new KategoriService();
    }
    function home()
    {
        $isLogin = MySession::adminSession();
        if ($isLogin['isLogin'] ==  true) {
            $jumlahPencari = $this->adminService->countPencariMagang();
            $jurusan  = $this->jurusanService->count();
            $sekolah = $this->sekolahService->count();
            $penyedia = $this->service->count();
            $kategori = $this->kategoriService->count();
            $jenis = $this->jenisUsahaService->count();

            $model = [
                'title' => "ADMIN||GOINTERN",
                'content' => "Go Intern",
                "nama" => $isLogin['nama'],
                "jmlPencari" => $jumlahPencari['jumlah'],
                "jurusan" => $jurusan , 
                "penyedia"=> $penyedia , 
                "sekolah" => $sekolah , 
                "jenis_usaha" => $jenis , 
                "kategori" => $kategori
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
            $response = $this->kategoriService->findAll();
            $model = [
                'title' => "ADMIN || KATEGORI",
                "content" => "KATEGORI PAGE",
                "data" => $response

            ];
            View::renderAdmin("kategori", $model);
        }
    }

    function addKategori()
    {
        $session = MySession::adminSession();
        if ($session['isLogin']) {
            define('KB', 1024);
            define('MB', 1048576);
            define('GB', 1073741824);
            define('TB', 1099511627776);
            // var_dump($_FILES);
            $file = $_FILES['foto'];
            $kategori = $_POST['kategori'];
            if (isset($_POST['submit'])) {
                $size = $file['size'];
                if ($size > 0 && $file['error'] == 0) {
                    $name = $file['name'];
                    $tmp = $file['tmp_name'];
                    $exploded = explode(".", $name);
                    if ($size > 5 * MB) {
                        Helper::showMessage("Ukuran foto tidak boleh lebih dari 5 MB", "/admin/kategori");
                    } else {
                        $namebeforeHash = $exploded[0];
                        $extensions = $exploded[1];
                        $tempname = md5($namebeforeHash) . rand() . "." . $extensions;
                        $responseMove = MoveFile::moveFilePenyedia($tmp, $tempname, "kategori");
                        if ($responseMove['status'] == 'oke') {
                            $response = $this->kategoriService->addKategori($kategori, $tempname);
                            Helper::showMessage($response['message'], "/admin/kategori");
                        } else {
                            Helper::showMessage("gagal menambahkan foto Terjadi kesalahan", "/admin/kategori");
                        }
                    }
                } else {
                    Helper::showMessage("Harap pilih foto terlebih dahulu", "/admin/kategori");
                }
            }
        } else {
            $model = [
                "title" => "ADMIN || LOGIN",
                "content" => "Login Page"
            ];
            View::renderAdminLogin("login", $model);
        }
    }

    function updateKategori()
    {
        $session = MySession::adminSession();
        if ($session['isLogin']) {
            if (isset($_POST['submit'])) {
                $file = $_FILES['fotoUpdate'];
                $kategori = $_POST['updateKategori'];
                $id = $_POST['id'];
                define('KB', 1024);
                define('MB', 1048576);
                define('GB', 1073741824);
                define('TB', 1099511627776);
                $size = $file['size'];
                if ($size > 5 * MB) {
                    Helper::showMessage("Gagal memperbarui kategori , foto tidak boleh lebih dari 2 MB", "/admin/kategori");
                } else {
                    $name = $file['name'];
                    $tmp = $file['tmp_name'];
                    $exploded = explode(".", $name);
                    $namebeforeHash = $exploded[0];
                    $extensions = $exploded[1];
                    $finalName = md5($namebeforeHash) . rand() . "." . $extensions;
                    $responseUpdate =  $this->kategoriService->updateKategori($kategori, $finalName, $id, $tmp, $size);
                    Helper::showMessage($responseUpdate['message'], "/admin/kategori");
                }
            } else {
                $response = $this->kategoriService->findAll();
                $model = [
                    'title' => "ADMIN || KATEGORI",
                    "content" => "KATEGORI PAGE",
                    "data" => $response

                ];
                View::renderAdmin("kategori", $model);
            }
        } else {
            $model = [
                "title" => "ADMIN || LOGIN",
                "content" => "Login Page"
            ];
            View::renderAdminLogin("login", $model);
        }
    }

    function deleteKategori()
    {
        $path = $_SERVER['PATH_INFO'];
        $exploded = explode("/", $path);
        $id = $exploded[4];
        $response = $this->kategoriService->deleteKategori($id);
        Helper::showMessage($response['message'], "/admin/kategori");
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
    function getUserRegristations()
    {
        $response = $this->adminService->getUsersRegristations();
        echo json_encode($response);
    }

    function getCompanRegristations()
    {
        $response = $this->adminService->getCompanyRegristation();
        echo json_encode($response);
    }
}
