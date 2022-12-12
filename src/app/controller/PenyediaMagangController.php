<?php


namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Domain\Syarat;
use LearnPhpMvc\dto\MagangRequest;
use LearnPhpMvc\dto\PenyediaMagangRequest;
use LearnPhpMvc\dto\SyaratRequest;
use LearnPhpMvc\helper\MoveFile;
use LearnPhpMvc\service\LowonganMagangService;
use LearnPhpMvc\service\MagangService;
use LearnPhpMvc\service\PenyediaMagangService;
use LearnPhpMvc\service\SyaratService;
use LearnPhpMvc\Session\MySession;

class PenyediaMagangController
{
    private MagangService $service;
    private SyaratService $syaratService;

    private PenyediaMagangService $penyediaMagangService;

    private LowonganMagangService $lowonganMagangService;
    public function __construct()
    {
        $this->service = new MagangService();
        $this->syaratService = new SyaratService();
        $this->penyediaMagangService = new PenyediaMagangService();
        $this->lowonganMagangService = new LowonganMagangService();
    }
    public function showLamaranMagang()
    {
        $session = MySession::getCurrentSession();
        $id = $session[0]['id'];
        $response = $this->lowonganMagangService->showLamaranMagang($id);
        return $response;
    }
    public function fetchSkill($id): array
    {
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => Url::BaseApi() . '/api/skill/showskillbypencari/' . $id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            )
        );
        $response = curl_exec($curl);
        $responseDecoded = json_decode($response, true);
        curl_close($curl);
        return $responseDecoded;
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
            View::renderHome("/penyedia/index", $model, "getFooter2");
        } else {
            LoginController::formLogin();
        }
    }

    public function testPhpInfo()
    {
        phpinfo();
    }

    function dashboardPenyedia()
    {
        $isLogin = MySession::getCurrentSession();
        $responseLamar = $this->showLamaranMagang();
        $id = $isLogin[0]['id'];
        $jumlahMagang = $this->penyediaMagangService->countMagang($id);
        $magangYangSedangDitempati = $this->penyediaMagangService->countMagangYangSedangDitempati($id);
        $lamaranMasuk = $this->penyediaMagangService->countLamaranMasuk($id);
        $jumlahPemagang = $this->penyediaMagangService->countPemagang($id);
        if ($isLogin['status'] != false) {
            $isLogin = MySession::getCurrentSession();
            $magang = $this->service->findAll();

            $model = [
                "title" => "Dashboard Penyedia",
                "result" => $isLogin,
                "magang" => $magang,
                "lamaran" => $responseLamar,
                "jumlahMagang" => $jumlahMagang,
                "jumlahMagangYangDitempati" => $magangYangSedangDitempati,
                "jumlahLamaranMasuk" => $lamaranMasuk,
                "jumlahPemagang" => $jumlahPemagang
                // "response" => $responseLamar
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
                if ($isLogin[0]['foto'] == null) {
                    echo "<script>
                    alert('gagal menambahkan magang , kamu harus melengkapi foto mu terlebih dahulu , klik namamu pojok kanan atas sekarang ! ');
                    window.location.href='/company/home/dashboard/tambah/magang';
                    </script>";
                } else {
                    if (isset($_POST['save'])) {
                        $posisi_magang = $_POST['posisi_magang'];
                        $lama_magang = $_POST['lama_magang'];
                        $jumlah_maksimal = $_POST['jumlah_maksimal'];
                        $syarat = $_POST['syarat'];
                        $deskripsi = $_POST['deskripsi'];
                        $kategori = $_POST['kategori'];
                        $salary = $_POST['salary'];
                        $syaratData = explode(',', $syarat);
                        $magangRequest = new MagangRequest();
                        $magangRequest->setPosisi_magang($posisi_magang);
                        $magangRequest->setLama_magang($lama_magang);
                        $magangRequest->setJumlah_maksimal($jumlah_maksimal);
                        $magangRequest->setPenyedia($isLogin[0]['id']);
                        $magangRequest->setDeskripsi($deskripsi);
                        $magangRequest->setKategori($kategori);
                        $magangRequest->setSalary($salary);
                        $responseMagang = $this->service->addMagang($magangRequest);
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
                $salary = $_POST['salaryUpdate'];
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
                        if ($i > 8) {
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
                                var_dump($syaratValidasi, $syaratValidasiOld);
                            } else if ($lengthOfValueNotNull == $lenthDataOld) {
                                $statusVal = false;
                                // todo update data
                                for ($i = 0; $i < $lengthOfValueNotNull; $i++) {
                                    # code...
                                    if ($posisi_magang == $dataDecoded[1] && $kategori == $dataDecoded[2] && $lama_magang == $dataDecoded[3] && $jumlah_maksimal == $dataDecoded[5] && $deskripsi == $dataDecoded[7] && $dataDecoded[8] == $salary && $syaratValidasi[$i] == $syaratValidasiOld[$i]) {
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
                                            $responseupdate = $this->syaratService->updateSyarat($syarat);
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
                    $magangRequest->setSalary($salary);
                    $arr = $this->service->updateData($magangRequest);
                    if ($arr['status'] == 'oke') {
                        echo "<script>alert('Berhasil mempsdferbarui data');window.location.href='/company/home/dashboard/tambah/magang'</script>";
                    } else {
                        echo "<script>alert('" . $arr['message'] . "');window.location.href='/company/home/dashboard/tambah/magang'</script>";
                    }
                }
                var_dump($dataDecoded);
            }
        } {
        }
    }
    public function deleteMagang()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $id = $jsonData['id'];
        $magangRequest = new MagangRequest();
        $magangRequest->setId($id);
        $response = $this->service->deleteById($magangRequest);
        echo json_encode($response);
    }

    public function updateDataProfile()
    {
        $isLogin = MySession::getCurrentSession();

        $image = $_FILES['image'];
        $tmp_name = $image['tmp_name'];
        $name_file = $image['name'];
        $idUser = $isLogin[0]['id'];
        $usernameUser = $isLogin[0]['username'];
        $namaPeursahanUser = $isLogin[0]['nama_perusahaan'];
        $no_telpUser = $isLogin[0]['no_telp'];
        $fotoUser = $isLogin[0]['foto'];
        $jenisUsahaUser = $isLogin[0]['jenis_usaha'];
        $emailUser = $isLogin[0]['email'];
        $tokenUser = $isLogin[0]['token'];
        $alamatUser = $isLogin[0]['alamat'];

        $rand = substr(md5(microtime()), rand(0, 26), 5);
        $nameDecoded = md5($name_file);
        $fotoExtensions = explode(".", $name_file);
        $fullNameFoto = $nameDecoded . "." . $fotoExtensions[1];
        if (isset($_POST)) {
            $username = $_POST['usernameUpdate'];
            $namaPerusahaanUpdate = $_POST['namaPerusahaanUpdate'];
            $noTelpUpdate = $_POST['no_telpUpdate'];
            $alamatUpdate = $_POST['alamatUpdate'];
            $emailUpdate = $_POST['emailUpdate'];
            $jenisUsahaUpdate = $_POST['jenisUsahaUpdate'];
            $penyediMagangRequest = new PenyediaMagangRequest();
            $penyediMagangRequest->setNamaPerushaan($namaPerusahaanUpdate);
            $penyediMagangRequest->setAlamatPerushaan($alamatUpdate);
            $penyediMagangRequest->setEmail($emailUpdate);
            $penyediMagangRequest->setNoTelp($noTelpUpdate);
            $penyediMagangRequest->setUsername($username);
            $penyediMagangRequest->setJenisUsaha($jenisUsahaUpdate);
            $penyediMagangRequest->setFoto($nameDecoded . "." . $fotoExtensions[1]);
            $penyediMagangRequest->setId($isLogin[0]['id']);
            if ($usernameUser == $username && $namaPeursahanUser == $namaPerusahaanUpdate && $no_telpUser == $noTelpUpdate && $jenisUsahaUser == $jenisUsahaUpdate && $emailUser == $emailUpdate && $alamatUser == $alamatUpdate) {
                echo "<script>alert('Tidak ada perubahan data');window.location.href='/company/home/dashboard/tambah/magang'</script>";
            } else {
                if ($name_file == "") {
                    // todo no update without foto 
                    $responseUpdate = $this->penyediaMagangService->updateDataProfile($penyediMagangRequest);
                } else {
                    // todo update foto
                    $penyediaMagangRequestPhoto = new PenyediaMagangRequest();
                    $penyediaMagangRequestPhoto->setFoto($fullNameFoto);
                    $penyediaMagangRequestPhoto->setId($isLogin[0]['id']) .
                        $resposeResult = $this->penyediaMagangService->updatePathPhoto($penyediaMagangRequestPhoto);
                    $response = MoveFile::moveFilePenyedia($tmp_name, $fullNameFoto, 'avatarpenyedia');
                    $responseUpdate = $this->penyediaMagangService->updateDataProfile($penyediMagangRequest);
                }
            }
        } else {
        }
    }

    public function updateDataProfilenotModal()
    {
        $isLogin = MySession::getCurrentSession();

        $image = $_FILES['image'];
        $tmp_name = $image['tmp_name'];
        $name_file = $image['name'];
        $idUser = $isLogin[0]['id'];
        $usernameUser = $isLogin[0]['username'];
        $namaPeursahanUser = $isLogin[0]['nama_perusahaan'];
        $no_telpUser = $isLogin[0]['no_telp'];
        $fotoUser = $isLogin[0]['foto'];
        $jenisUsahaUser = $isLogin[0]['jenis_usaha'];
        $emailUser = $isLogin[0]['email'];
        $tokenUser = $isLogin[0]['token'];
        $alamatUser = $isLogin[0]['alamat'];

        $rand = substr(md5(microtime()), rand(0, 26), 5);
        $nameDecoded = md5($name_file);
        $fotoExtensions = explode(".", $name_file);
        $fullNameFoto = $nameDecoded . "." . $fotoExtensions[1];
        if (isset($_POST)) {
            $username = $_POST['usernameUpdate'];
            $namaPerusahaanUpdate = $_POST['namaPerusahaanUpdate'];
            $noTelpUpdate = $_POST['no_telpUpdate'];
            $alamatUpdate = $_POST['alamatUpdate'];
            $emailUpdate = $_POST['emailUpdate'];
            $jenisUsahaUpdate = $_POST['jenisUsahaUpdate'];
            $penyediMagangRequest = new PenyediaMagangRequest();
            $penyediMagangRequest->setNamaPerushaan($namaPerusahaanUpdate);
            $penyediMagangRequest->setAlamatPerushaan($alamatUpdate);
            $penyediMagangRequest->setEmail($emailUpdate);
            $penyediMagangRequest->setNoTelp($noTelpUpdate);
            $penyediMagangRequest->setUsername($username);
            $penyediMagangRequest->setJenisUsaha($jenisUsahaUpdate);
            $penyediMagangRequest->setFoto($nameDecoded . "." . $fotoExtensions[1]);
            $penyediMagangRequest->setId($isLogin[0]['id']);
            if ($usernameUser == $username && $namaPeursahanUser == $namaPerusahaanUpdate && $no_telpUser == $noTelpUpdate && $jenisUsahaUser == $jenisUsahaUpdate && $emailUser == $emailUpdate && $alamatUser == $alamatUpdate) {
                echo "<script>alert('Tidak ada perubahan data');window.location.href='/company/home/dashboard/profile'</script>";
            } else {
                if ($name_file == "") {
                    // todo no update without foto 
                    $responseUpdate = $this->penyediaMagangService->updateDataProfile($penyediMagangRequest);
                } else {
                    // todo update foto
                    $penyediaMagangRequestPhoto = new PenyediaMagangRequest();
                    $penyediaMagangRequestPhoto->setFoto($fullNameFoto);
                    $penyediaMagangRequestPhoto->setId($isLogin[0]['id']) .
                        $resposeResult = $this->penyediaMagangService->updatePathPhoto($penyediaMagangRequestPhoto);
                    $response = MoveFile::moveFilePenyedia($tmp_name, $fullNameFoto, 'avatarpenyedia');
                    $responseUpdate = $this->penyediaMagangService->updateDataProfile($penyediMagangRequest);
                }
            }
        } else {
        }
    }

    public function downloadCv()
    {

        $this->penyediaMagangService->downloadCv();
    }

    public function updatePhotoProfile()
    {
        if (isset($_POST['submit'])) {
            if (isset($_FILES['fotofile'])) {
                if ($_FILES['fotofile']['error'] > 0) {
                    echo "<script>
                alert('gagal mengganti foto profile! , harap pilih foto terlebih dahulu ');
                window.location.href='/company/home/dashboard';
                </script>";
                } else {
                    $image = $_FILES['fotofile'];
                    $tmp_name = $image['tmp_name'];
                    $name_file = $image['name'];
                    $isLogin = MySession::getCurrentSession();
                    $rand = substr(md5(microtime()), rand(0, 26), 5);
                    $nameDecoded = md5($name_file);
                    $fotoExtensions = explode(".", $name_file);
                    $fullNameFoto = $nameDecoded . $rand . "." . $fotoExtensions[1];
                    $penyediaMagangRequestPhoto = new PenyediaMagangRequest();
                    $penyediaMagangRequestPhoto->setFoto($fullNameFoto);
                    $penyediaMagangRequestPhoto->setId($isLogin[0]['id']) .
                        $resposeResult = $this->penyediaMagangService->updatePathPhoto($penyediaMagangRequestPhoto);
                    if ($resposeResult) {
                        $response = MoveFile::moveFilePenyedia($tmp_name, $fullNameFoto, 'avatarpenyedia');
                        if ($response['status'] == 'oke') {
                            echo "<script>
                            alert('Berhasil mengganti foto profile! , silahkan login ulang');
                            window.location.href='/login';
                            </script>";
                            if (isset($_COOKIE['GO-INTERN-COCKIE'])) {
                                unset($_COOKIE['GO-INTERN-COCKIE']);
                                setcookie('GO-INTERN-COCKIE', null, -1, '/');
                                return true;
                            } else {
                                return false;
                            }
                        } else {
                            echo "<script>
                            alert('gagal mengganti foto profile!');
                            window.location.href='/company/home/dashboard';
                            </script>";
                        }
                    } else {
                        echo "<script>
                        alert('gagal mengganti foto profile!');
                        window.location.href='/company/home/dashboard';
                        </script>";
                    }
                }
            } else {
                echo "<script>
                alert('gagal mengganti foto profile! , harap pilih foto terlebih dahulu ');
                window.location.href='/company/home/dashboard';
                </script>";
            }
        } else {

            View::redirect("company/home/dashboardqw");
        }
    }


    public function downloadPenghargaan()
    {
        $this->penyediaMagangService->downloadPenghargaan();
    }

    public function formLamaran()
    {
        $dataLamaran = $this->showLamaranMagang();
        $isLogin = MySession::getCurrentSession();
        $data = $this->fetchSkill(150);

        $count = 0;
        foreach ($dataLamaran['body'] as $key => $value) {
            $dataLamaran['body'][$count]['skilss'] = array();
            $data = $this->fetchSkill($value['id_pencari']);
            array_push($dataLamaran['body'][$count]['skilss'], $data['skills']);
            $count++;
        }
        $model = array(
            "lamaran" => $dataLamaran,
            "result" => $isLogin,
        );
        View::renderDashboard('lamaran', $model);
    }

    public function tolakLamaran()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $idPencari = $jsonData['pencari'];
        $idMagang = $jsonData['magang'];
        $idpenyedia = $jsonData['penyedia'];
        $response = $this->lowonganMagangService->tolakLamaran($idPencari, $idMagang, $idpenyedia);
        echo json_encode($response);
    }

    public function terimaLamaran()
    {
        // baseurl + /company/home/dashboard/lamaran/acc
        // $this->lowonganMagangService->terimaMagang();
        $idPencari = $_POST['id_pencari'];
        $idMagang = $_POST['id_magang'];
        if (isset($_POST['submit'])) {
            $response = $this->lowonganMagangService->terimaMagang($idPencari, $idMagang);
            echo "<script>alert('" . $response['message'] . "');window.location.href='/company/home/dashboard/tambah/magang'</script>";
        } else {
            View::redirect("company/home/dashboard");
        }
    }

    public function terimaLamaranWithJS()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $idPencari = $jsonData['idPencari'];
        $idMagang = $jsonData['idmagang'];
        $response = $this->lowonganMagangService->terimaMagang($idPencari, $idMagang);
        echo json_encode($response);
    }

    public function dataPemagang()
    {
        $isLogin = MySession::getCurrentSession();
        $id = $isLogin[0]['id'];
        $dataPemagang = $this->lowonganMagangService->showPemagang($id);
        $model = array(
            "title" => "Go intern || pemagang",
            "result" => $isLogin,
            "dataPemagang" => $dataPemagang

        );
        View::renderDashboard("pemagang", $model);
    }

    public function profile()
    {
        $isLogin = MySession::getCurrentSession();
        $model = array(
            "result" => $isLogin
        );
        View::renderDashboard("profile", $model);
    }

    public function keluarkanPemagang()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $idLowongan = $jsonData['idlowongan'];
        $pemagang = $jsonData['pemagang'];
        $response = $this->lowonganMagangService->keluarkanPemagang($idLowongan, $pemagang);
        echo "<script>alert('" . $response['message'] . "');'</script>";
        echo json_encode($response);
    }


    public function showPosisiPopuler()
    {
        // need to know the id penyedia 
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $id = $jsonData['id'];
        $response = $this->lowonganMagangService->showPosisiPalingBannyakDiminati($id);
        echo json_encode($response);
    }
    
    public function logout()
    {
        // delete cockie\
        setcookie("GO-INTERN-COCKIE", "", time() - 3600, "/", Url::domain());
        setcookie("id", "", time() - 3600, "/", Url::domain());
        View::redirect("login");
    }

    public function updatePassword()
    {
        if (isset($_POST['updatePassword'])) {
            $passwordBaru = $_POST['passwordBaru'];
            $passwordLama = $_POST['passwordLama'];
            $konfirmasiPassword = $_POST['konfirmasiPassword'];
            $id = $_POST['id'];
            $response =  $this->penyediaMagangService->updatePassword($passwordLama, $passwordBaru, $konfirmasiPassword, $id);
            if ($response['status'] == 'oke') {
                setcookie("GO-INTERN-COCKIE", "", time() - 3600, "/", Url::domain());
                setcookie("id", "", time() - 3600, "/", Url::domain());
                echo "<script>alert('" . $response['message'] . "');window.location.href='/login'</script>";
            } else {
                echo "<script>alert('" . $response['message'] . "');window.location.href='/company/home/dashboard'</script>";
            }
        } else {
        }
    }
}
