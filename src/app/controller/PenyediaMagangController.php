<?php


namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Domain\Syarat;
use LearnPhpMvc\dto\MagangRequest;
use LearnPhpMvc\dto\SyaratRequest;
use LearnPhpMvc\service\MagangService;
use LearnPhpMvc\service\SyaratService;
use LearnPhpMvc\Session\MySession;

class PenyediaMagangController
{
    private MagangService $service;
    private SyaratService $syaratService;

    public function __construct()
    {
        $this->service = new MagangService();
        $this->syaratService = new SyaratService();
    }

    static function home()
    {
        $isLogin = MySession::getCurrentSession();
        if ($isLogin['status'] != false) {
            $model = [
                'title' => "Isi Data Lamaran",
                'content' => "Go Intern",
                'result' => $isLogin
            ];
            View::render("/penyedia/index", $model, "getFooter2");
        } else {
            LoginController::formLogin();
        }
    }

    function dashboardPenyedia()
    {
        $isLogin = MySession::getCurrentSession();
        if ($isLogin['status'] != false) {
            $isLogin = MySession::getCurrentSession();
            $magang = $this->service->findAll();
            $model = [
                "title" => "Dashboard Penyedia",
                "result" => $isLogin,
                "magang" => $magang
            ];
            View::renderDashboard("index", $model);
        } else {
            LoginController::formLogin();
        }
    }

    function formTambahData()
    {

        $isLogin = MySession::getCurrentSession();
        $magangRequest = new MagangRequest();
        $magangRequest->setPenyedia($isLogin[0]['id']);
        $dataMagang = $this->service->showMagang($magangRequest);
        
        if ($dataMagang['status'] == "oke") {
            var_dump($dataMagang['body']);
            for ($i = 0; $i < sizeof($dataMagang['body']); $i++) {
                # code...
                $syaratRequest = new SyaratRequest();
                $syaratRequest->setId_magang($dataMagang['body'][$i]['id']);
                $dataMagang['body'][$i]['syarat'] = array();
                $dataSyarat = $this->syaratService->showSyarat($syaratRequest);
                array_push($dataMagang['body'][$i]['syarat'], $dataSyarat['body']);
            }
            $model = [
                "title" => "Dashboard Penyedia",
                "result" => $isLogin,
                "magang" => $dataMagang
            ];
            View::renderDashboard("tambah_magang", $model);
        } else {
            $model = [
                "title" => "Dashboard Penyedia",
                "result" => $isLogin,
            ];
            View::renderDashboard("tambah_magang", $model);
        }
    }
    function tambahDataPost()
    {
        $isLogin = MySession::getCurrentSession();
        if ($isLogin['status'] == true) {
            if (isset($_POST)) {
                if (isset($_POST['save'])) {
                    $posisi_magang = $_POST['posisi_magang'];
                    $lama_magang = $_POST['lama_magang'];
                    $jumlah_maksimal = $_POST['jumlah_maksimal'];
                    $syarat = $_POST['syarat'];
                    $deskripsi = $_POST['deskripsi'];
                    $kategori = $_POST['kategori'];
                    $syaratData = explode(',', $syarat);
                    $magangRequest = new MagangRequest();
                    $magangRequest->setPosisi_magang($posisi_magang);
                    $magangRequest->setLama_magang($lama_magang);
                    $magangRequest->setJumlah_maksimal($jumlah_maksimal);
                    $magangRequest->setPenyedia($isLogin[0]['id']);
                    $magangRequest->setDeskripsi($deskripsi);
                    $magangRequest->setKategori($kategori);
                    $responseMagang =   $this->service->addMagang($magangRequest);
                    $syaratReq = new SyaratRequest();
                    $syaratReq->setId_magang($responseMagang['body'][0]['id']);
                    foreach ($syaratData as $key => $value) {
                        # code...
                        $syaratReq->setSyarat($value);
                        $this->syaratService->addSyarat($syaratReq);
                    }
                    if ($responseMagang['status'] == 'oke') {
                        $_SESSION['succes'] = 'succes';
                        // View::renderDashboard("tambah_magang", $responseMagang);
                        echo "<script>
                        alert('Berhasil Menambahkan Magang ');
                        window.location.href='/company/home/dashboard/tambah/magang';
                        </script>";
                        // View::redirect('company/home/dashboard/tambah/magang');
                    }
                }
            }
        } else {
            View::redirect("login");
        }
    }
    public function updateData()
    {
        // cek session apakah , user sudah login atau belum
        $isLogin = MySession::getCurrentSession();
        if ($isLogin['status'] == false) {
            View::redirect("login");
        } else {
            // cek variable post sudah di set atau belum
            if (isset($_POST)) {
                // inisalisasi masing2 variable
                $posisi_magang = $_POST['posisi_magangUpdate'];
                $kategori = $_POST['kategoriUpdate'];
                $lama_magang = $_POST['lama_magangUpdate'];
                $jumlah_maksimal = $_POST['jumlah_maksimalUpdate'];
                $deskripsi = $_POST['deskripsiUpdate'];
                $syarat = $_POST['syaratUpdate'];
                // pecah variable syarat menjadi array 
                $syaratResult = explode(",", $syarat); // array
                $syaratDataOld = array();
                $dataCokcie = "";
                $dataDecoded = "";
                // cek cockie update data yang di set dari js
                if (isset($_COOKIE['updateDataGoIntern'])) {
                    $dataCokcie = $_COOKIE['updateDataGoIntern'];
                    $dataDecoded = explode(",", $dataCokcie);
                    $lentgh = sizeof($dataDecoded);
                    for ($i = 0; $i <= $lentgh - 1; $i++) {
                        # code...
                        if ($i >= 8) {
                            $syaratTemp = $dataDecoded[$i];
                            array_push($syaratDataOld, $syaratTemp);
                        }
                    }
                }
                // inisialisasi length untuk batas perulahan
                $lengthOfValueNotNull = 0;
                $lenthDataOld = 0;
                // buat array untuk validasi data syarat
                $syaratValidasiOld = array();
                for ($i = 0; $i < sizeof($syaratDataOld); $i++) {
                    # code...
                    if ($syaratDataOld[$i] != "") {
                        $lenthDataOld++;
                        array_push($syaratValidasiOld, $syaratDataOld[$i]);
                    }
                }
                $syaratValidasi = array();

                foreach ($syaratResult as $key => $value) {
                    if ($syaratResult[$key] != "") {
                        array_push($syaratValidasi, $syaratResult[$key]);
                    }
                }
                foreach ($syaratResult as $key => $value) {
                    if ($syaratResult[$key] != "") {
                        $lengthOfValueNotNull++;
                    }
                }
                // jika panjang dari syarat old  , 0 maka insert 
                if ($lenthDataOld == 0) {
                    $syaratUpdateDataTemp = $_POST['syaratUpdate'];
                    $syaratUpdateDecodeFromArray = explode(",", $syaratUpdateDataTemp);
                    for ($i = 0; $i < sizeof($syaratUpdateDecodeFromArray); $i++) {
                        $syaratUppdateVar = new SyaratRequest();
                        $syaratUppdateVar->setSyarat($syaratUpdateDecodeFromArray[$i]);
                        $syaratUppdateVar->setId_magang($dataDecoded[0]);
                        $this->syaratService->addSyarat($syaratUppdateVar);
                    }
                } else {
                    // lakukan perulangan dari syarat tersebut
                    foreach ($syaratResult as $key => $value) {
                        if ($value == "") {
                            // todo not update or insert but send notification        
                        } else {
                            // ambil data jika value dari array tidak null   
                            if ($lengthOfValueNotNull < $lenthDataOld) {
                                // todo delete data and insert data
                                $syaratRequest = new SyaratRequest();
                                $syaratRequest->setId_magang($dataDecoded[0]);
                                $this->syaratService->deleteSyarat($syaratRequest);
                                $syaratUpdateDataTemp = $_POST['syaratUpdate'];
                                $syaratUpdateDecodeFromArray = explode(",", $syaratUpdateDataTemp);
                                for ($i = 0; $i < sizeof($syaratUpdateDecodeFromArray); $i++) {
                                    $syaratUppdateVar = new SyaratRequest();
                                    $syaratUppdateVar->setSyarat($syaratUpdateDecodeFromArray[$i]);
                                    $syaratUppdateVar->setId_magang($dataDecoded[0]);
                                    $this->syaratService->addSyarat($syaratUppdateVar);
                                }
                            } else if ($lengthOfValueNotNull == $lenthDataOld) {
                                $statusVal = false;
                                // todo update data
                                for ($i = 0; $i < $lengthOfValueNotNull; $i++) {
                                    # code...
                                    if ($posisi_magang == $dataDecoded[1] && $kategori == $dataDecoded[2] && $lama_magang == $dataDecoded[3] && $jumlah_maksimal == $dataDecoded[5] && $deskripsi == $dataDecoded[7] && $syaratValidasi[$i] == $syaratValidasiOld[$i]) {
                                        $statusVal = false;
                                    } else {
                                        $statusVal = true;
                                        $syarat = new SyaratRequest();
                                        $syaratfind = new SyaratRequest();
                                        $syaratfind->setSyarat($syaratValidasiOld[$i]);
                                        $syaratfind->setId_magang($dataDecoded[0]);
                                        $response = $this->syaratService->findBySyarat($syaratfind);
                                        $syaratUppdateVar = new SyaratRequest();
                                        $syaratUpdateDataTemp = $_POST['syaratUpdate'];
                                        $syaratUppdateVar->setId_magang($dataDecoded[0]);
                                        $syaratUpdateDecodeFromArray = explode(",", $syaratUpdateDataTemp);
                                        if ($response['status'] == "ok") {
                                            $id = $response['body'][0]['id'];
                                            $syarat->setId($id);
                                            $syarat->setSyarat($syaratUpdateDecodeFromArray[$i]);
                                            $syarat->setId_magang($dataDecoded[0]);
                                            $responseupdate =  $this->syaratService->updateSyarat($syarat);
                                        }
                                    }
                                }
                                if ($statusVal) {
                                    echo "<script>alert('Berhasil memperbarui data');window.location.href='/company/home/dashboard/tambah/magang'</script>";
                                } else {
                                    echo "<script>alert('tidak ada perubahan data');window.location.href='/company/home/dashboard/tambah/magang'</script>";
                                }
                            } else {
                                $syaratUppdateVar = new SyaratRequest();
                                $syaratUpdateDataTemp = $_POST['syaratUpdate'];
                                $syaratUppdateVar->setId_magang($dataDecoded[0]);
                                $deleteResponse = $this->syaratService->deleteSyarat($syaratUppdateVar);
                                $syaratUpdateDecodeFromArray = explode(",", $syaratUpdateDataTemp);
                                for ($i = 0; $i < sizeof($syaratUpdateDecodeFromArray); $i++) {
                                    $syaratUppdateVar->setSyarat($syaratUpdateDecodeFromArray[$i]);

                                    $this->syaratService->addSyarat($syaratUppdateVar);
                                }
                                break;
                            }
                        }
                    }
                }
                //update data ketika ada perubahan
                $syaratValidasi = array();
                foreach ($syaratResult as $key => $value) {
                    if ($syaratResult[$key] != "") {
                        array_push($syaratValidasi, $syaratResult[$key]);
                    }
                }
                $status = false;
                for ($i = 0; $i < sizeof($syaratValidasi); $i++) {
                    # code...
                    if ($posisi_magang == $dataDecoded[1] && $kategori == $dataDecoded[2] && $lama_magang == $dataDecoded[3] && $jumlah_maksimal == $dataDecoded[5] && $deskripsi == $dataDecoded[7] && $syaratValidasi[$i] == $syaratValidasiOld[$i]) {
                        $status = true;
                    } else {
                        $status = false;
                    }
                }
                if ($status) {
                    echo "<script>alert('tidak ada perubahan data');window.location.href='/company/home/dashboard/tambah/magang'</script>";
                } else {
                    $magangRequest = new MagangRequest();
                    $magangRequest->setPosisi_magang($posisi_magang);
                    $magangRequest->setKategori($kategori);
                    $magangRequest->setLama_magang($lama_magang);
                    $magangRequest->setJumlah_maksimal($jumlah_maksimal);
                    $magangRequest->setDeskripsi($deskripsi);
                    $magangRequest->setId($dataDecoded[0]);
                    $arr = $this->service->updateData($magangRequest);
                    if ($arr['status'] == 'oke') {
                        echo "<script>alert('Berhasil memperbarui data');window.location.href='/company/home/dashboard/tambah/magang'</script>";
                    } else {
                        echo "<script>alert('" . $arr['message'] . "');window.location.href='/company/home/dashboard/tambah/magang'</script>";
                    }
                }
            }
        } {
        }
    }
    public function deleteMagang()
    {
        $path = $_SERVER['PATH_INFO'];
        $idTemp = explode("/", $path);
        $id = $idTemp[7];
        if ($id != null) {
            $magangRequest = new MagangRequest();
            $magangRequest->setId($id);
            $response = $this->service->deleteById($magangRequest);
            echo "<script>alert('" . $response['message'] . "');window.location.href='/company/home/dashboard/tambah/magang'</script>";
        }
    }
}
