<?php

namespace LearnPhpMvc\controller\admin;


use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Sekolah;
use LearnPhpMvc\helper\Helper as HelperHelper;
use LearnPhpMvc\helper\Helper;
use LearnPhpMvc\repository\JurusanRepository;
use LearnPhpMvc\service\JurusanService;
use LearnPhpMvc\service\PenyediaMagangService;
use LearnPhpMvc\service\SekolahService;

class AdminController
{


    private PenyediaMagangService $service;
    private SekolahService $sekolahService;

    private JurusanService $jurusanService;



    function __construct()
    {
        $this->sekolahService = new SekolahService();
        $this->service = new PenyediaMagangService();
        $repositoryJurusan = new JurusanRepository(Database::getConnection());
        $this->jurusanService = new JurusanService($repositoryJurusan);
    }

    function home()
    {
        $model = [
            'title' => "Belajar php mvc",
            'content' => "Go Intern"
        ];

        View::renderAdmin("index", $model);
    }

    function login()
    {
        $model = [
            'title' => "Login",
            "content" => "login page"
        ];
        View::renderAdminLogin("login", $model);
    }

    function kategori()
    {

        $model = [
            'title' => "Login",
            "content" => "login page"
        ];
        View::renderAdmin("kategori", $model);
    }

    function addKategori()
    {
        $kategori = $_POST['kategori'];
        echo $kategori;
    }

    function penyedia()
    {
        $responsePenyedia = $this->service->findAll();
        $model = [
            'title' => "penyedia",
            "content" => "Penyedia",
            "data" => $responsePenyedia
        ];
        View::renderAdmin("penyedia", $model);
    }
    // sekolah
    function sekolah()
    {
        $responseDataSekolah = $this->sekolahService->findAll();
        $model = [
            'title' => "penyedia",
            "content" => "Penyedia",
            "data" => $responseDataSekolah

        ];
        View::renderAdmin("sekolah", $model);
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
        $model = [
            'title' => "penyedia",
            "content" => "Penyedia",
            "data" => $responseJurusan

        ];
        View::renderAdmin("jurusan", $model);
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
}
