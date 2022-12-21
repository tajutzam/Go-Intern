<?php

namespace LearnPhpMvc\service;

use Cassandra\Date;
use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\Penghargaan;
use LearnPhpMvc\Domain\Sekolah;
use LearnPhpMvc\Domain\Skill;
use LearnPhpMvc\dto\AktivasiAkunRequest;
use LearnPhpMvc\dto\AktivasiAkunResponse;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\RegisterPencariMagangRequest;
use LearnPhpMvc\dto\SearchKeyword;
use LearnPhpMvc\dto\UpdateOencariMagangRequest;
use LearnPhpMvc\dto\UpdatePencariMagangRequest;
use LearnPhpMvc\helper\MoveFile;
use LearnPhpMvc\repository\JurusanRepository;
use LearnPhpMvc\repository\PencariMagangRepository;
use LearnPhpMvc\repository\PenghargaanRepository;
use LearnPhpMvc\repository\SekolahRepository;
use LearnPhpMvc\repository\SkillRepository;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

use PHPUnit\TextUI\XmlConfiguration\Php;

class PencariMagangService
{
    private PencariMagangRepository $pencariMagangRepository;
    private SkillRepository $skilrepository;

    private JurusanRepository $jurusanRepository;
    private SekolahRepository $sekolahRepository;
    private PenghargaanRepository $penghargaanRepository;

    public function __construct(PencariMagangRepository $pencariMagangRepository, SkillRepository $skillRepository)
    {
        $this->pencariMagangRepository = $pencariMagangRepository;
        $this->skilrepository = $skillRepository;
        $this->sekolahRepository = new SekolahRepository(Database::getConnection());
        $this->jurusanRepository = new JurusanRepository(Database::getConnection());
        $this->penghargaanRepository = new PenghargaanRepository(Database::getConnection());
    }
    public function findAll(): array
    {
        // return array , cek di repository package
        return $this->pencariMagangRepository->findAll();
    }

    public function findByIdApi($id): array
    {
        $response = array();
        $response['body'] =  array();
        $resultObj = $this->pencariMagangRepository->findById($id);
        if ($resultObj != null) {
            $response['status'] = "oke";
            http_response_code(200);
            $item = array(
                "id" => $resultObj->getId(),
                "username" => $resultObj->getUsername(),
                "password" => $resultObj->getPassword(),
                "email" => $resultObj->getEmail(),
                "sekolah" => $resultObj->getIdSekolah() == null ? 0 : $resultObj->getIdSekolah(),
                "no_telp" => $resultObj->getNo_telp(),
                "agama" => $resultObj->getAgama() == null ? 'null' : $resultObj->getAgama(),
                "tangal_lahir" => $resultObj->getTanggalLahir(),
                "token" => $resultObj->getToken(),
                "cv" => $resultObj->getCv() ?? 'null',
                "resume" => $resultObj->getResume() ?? 'null',
                "status" => $resultObj->getStatus(),
                "statusMagang" => $resultObj->isStatusMagang(),
                "role" => $resultObj->getRole(),
                "create_at" => $resultObj->getCreate_at(),
                "update_at" => $resultObj->getUpdate_at(),
                "nama" => $resultObj->getNama(),
                "foto" => $resultObj->getFoto() ?? 'null',
                "jenis_kelamin" => $resultObj->getJenis_kelamin(),
                "surat_lamaran" => $resultObj->getSuratLamaran(),
                "jurusan" => $resultObj->getJurusan(),
                "penghargaan" => $resultObj->getPenghargaan(),
                "tentang_saya" => $resultObj->getTentang_saya()
            );
            array_push($response['body'], $item);
        } else {
            http_response_code(404);
            $response['status'] = 'failed';
            $response['message'] = "data tidak ditemukan";
        }
        return $response;
    }
    public function findByStatusAktif(): array
    {
        // return array , cek di repository package
        return $this->pencariMagangRepository->findByStatusAktiv();
    }
    public function login(LoginRequest $loginRequest): array
    {
        // buat object response dari mencari
        $loginResponse = $this->pencariMagangRepository->findByUsername($loginRequest->username);
        $response['body'] = array();
        if ($loginResponse['status'] == 'oke') {
            if ($loginResponse['body'][0]['status'] == "tidak_aktif") {
                http_response_code(400);
                $response['status'] = "failed";
                $response['message'] = "harap aktifasi akun anda terlebih dahulu";
            } else {
                if ($loginResponse['length'] = 1) {
                    if (password_verify($loginRequest->password, $loginResponse['body'][0]['password'])) {
                        http_response_code(200);
                        $response['message'] = "Berhasil login";
                        $skill = new  Skill();
                        $skill->setPencari_magang($loginResponse['body'][0]['id']);
                        array_push($response['body'], $loginResponse['body']);
                    } else {
                        http_response_code(401);
                        $message = array(
                            "status" => "failed",
                            "message" => "Gagal Login , harap check password atau username anda"
                        );
                        array_push($response['body'], $message);
                    }
                } else {
                }
            }
            //       
        } else {
            http_response_code(404);
            $response['status'] = "failed";
            array_push($response['body'], $loginResponse['status']);
        }
        return $response;
    }
    public function register(RegisterPencariMagangRequest $request): array
    {
        $response = array();
        $response['body'] = array();
        if ($request->getRole() == 1) {
            // admin
        } else if ($request->getRole() == 2) {
            // penyedia
        } else if ($request->getRole() == 3) {
            // pencari magang
            // todo pencari magang request
            try {
                if (
                    $request->getUsername() == null || $request->getPassword() == null || $request->getEmail() == null || $request->getCv() == null || $request->getResume() == null ||
                    $request->getAlamat() == null || $request->getNamaBelakang() == null || $request->getNamaDepan() == null || $request->getSkill() == null || $request->getIdSekolah() == null
                ) {
                    // Todo , send message null
                    http_response_code(400);
                    $response['status'] = "failed";
                    $response['message'] = "harap isi semua field";
                } else {
                    if (
                        $request->getUsername() == "" || $request->getPassword() == "" || $request->getEmail() == "" || $request->getCv() == "" || $request->getResume() == "" ||
                        $request->getAlamat() == "" || $request->getNamaBelakang() == "" || $request->getNamaDepan() == "" || $request->getSkill() == ""
                    ) {
                        http_response_code(400);
                        $response['status'] = "failed";
                        $response['message'] = "harap isi semua field";
                    } else {
                        $date = \date("Y-m-d");
                        $pencariMagang = new PencariMagang();
                        $sekolah = new Sekolah();
                        $pencariMagang->setUsername($request->getUsername());
                        $pencariMagang->setPassword($request->getPassword());
                        $pencariMagang->setEmail($request->getEmail());
                        $pencariMagang->setNo_telp($request->getNotelp());
                        $pencariMagang->setAgama($request->getAgama());
                        $pencariMagang->setTanggalLahir($date);
                        $pencariMagang->setToken($request->getToken());
                        $pencariMagang->setCv($request->getCv());
                        $pencariMagang->setResume($request->getResume());
                        $pencariMagang->setStatus("tidak_aktif");
                        $pencariMagang->setStatusMagang("tidak_magang");
                        $pencariMagang->setRole($request->getRole());
                        $pencariMagang->setFoto($request->getFoto());
                        $sekolah->id = $request->getIdSekolah();
                        $pencariMagang->setNama($request->getNamaDepan() . " " . $request->getNamaBelakang());
                        $saveResult = $this->pencariMagangRepository->save($pencariMagang, $sekolah);
                        if ($saveResult == null) {
                            http_response_code(401);
                            $response['status'] = "failed";
                            $response['status'] = "terjadi kesalahan";
                        } else {
                            $items = array(
                                "username" => $request->getUsername(),
                                "password" => $request->getPassword(),
                                "email" => $request->getEmail(),
                                "no_telp" => $request->getNotelp(),
                                "agama" => $request->getAgama(),
                                "tanggal_lahir" => $pencariMagang->getTanggalLahir(),
                                "token" => $request->getToken(),
                                "cv" => $request->getCv(),
                                "resume" => $request->getResume(),
                                "status" => $pencariMagang->getStatus(),
                                "status_magang" => $pencariMagang->isStatusMagang(),
                                "role" => $request->getRole(),
                                "foto" => $request->getFoto(),
                                "sekolah" => $request->getIdSekolah(),
                                "nama" => $pencariMagang->getNama()
                            );
                            array_push($response['body'], $items);
                            $response['status'] = "oke";
                            $response['message'] = "berhasil regristasi";
                        }
                    }
                }
            } catch (\Exception $exception) {
                $response['message'] = $exception->getMessage();
            }
        }
        return $response;
    }
    public function findByUsername($username): array
    {
        $byUsername = $this->pencariMagangRepository->findByUsername($username);
        return $byUsername;
    }
    public function registerMobile(RegisterPencariMagangRequest $request): array
    {
        $response = array();
        $response['body'] = array();
        $byUsername = $this->pencariMagangRepository->findByUsername($request->getUsername());
        if ($byUsername['status'] == "data tidak ditemukan") {
            if ($request->getRole() == 1) {
                // admin
            } else if ($request->getRole() == 2) {
                // penyedia
            } else if ($request->getRole() == 3) {
                // pencari magang
                // todo pencari magang request
                try {
                    if (
                        $request->getUsername() == null || $request->getPassword() == null || $request->getEmail() == null  ||
                        $request->getNamaBelakang() == null || $request->getNamaDepan() == null
                    ) {
                        // Todo , send message null
                        http_response_code(400);
                        $response['status'] = "failed";
                        $response['message'] = "harap isi semua field";
                    } else {
                        if (
                            $request->getUsername() == "" || $request->getPassword() == "" || $request->getEmail() == ""  ||
                            $request->getNamaBelakang() == "" || $request->getNamaDepan() == ""
                        ) {
                            http_response_code(400);
                            $response['status'] = "failed";
                            $response['message'] = "harap isi semua field";
                        } else {
                            if (preg_match('/\s/', $request->getUsername())) {
                                $response['status'] = "failed";
                                $response['message'] = "Harap isi username tanpa adanya space";
                            } else {
                                if (preg_match('~^\p{Lu}~u', $request->getUsername())) {
                                    $date = \date("Y-m-d");
                                    $pencariMagang = new PencariMagang();
                                    $sekolah = new Sekolah();
                                    $pencariMagang->setUsername($request->getUsername());
                                    $pencariMagang->setPassword(password_hash($request->getPassword(), PASSWORD_BCRYPT));
                                    $pencariMagang->setEmail($request->getEmail());
                                    $pencariMagang->setTanggalLahir($request->getTanggalLahir());
                                    $pencariMagang->setToken($request->getToken());
                                    $pencariMagang->setStatus("tidak_aktif");
                                    $pencariMagang->setStatusMagang("tidak_magang");
                                    $pencariMagang->setRole($request->getRole());
                                    // $pencariMagang->setIdSekolah($request->getIdSekolah());
                                    $pencariMagang->setNama($request->getNamaDepan() . " " . $request->getNamaBelakang());
                                    $pencariMagang->setJenis_kelamin($request->getJenis_kelamin());
                                    $saveResult = $this->pencariMagangRepository->savePencariMagnag($pencariMagang, $sekolah);
                                    if ($saveResult == null) {
                                        http_response_code(401);
                                        $response['status'] = "failed";
                                        $response['status'] = "terjadi kesalahan";
                                    } else {
                                        $items = array(
                                            "username" => $request->getUsername(),
                                            "password" => $request->getPassword(),
                                            "email" => $request->getEmail(),
                                            "tanggal_lahir" => $pencariMagang->getTanggalLahir(),
                                            "token" => $request->getToken(),
                                            "status" => $pencariMagang->getStatus(),
                                            "status_magang" => $pencariMagang->isStatusMagang(),
                                            "role" => $request->getRole(),
                                            //                                            "sekolah" => $request->getIdSekolah(),
                                            "nama" => $pencariMagang->getNama()
                                        );
                                        http_response_code(200);
                                        array_push($response['body'], $items);
                                        $response['status'] = "oke";
                                        $response['message'] = "berhasil regristasi";
                                    }
                                } else {
                                    $response['status'] = "failed";
                                    $response['message'] = "Username harus diawali dengan huruf Kapital";
                                }
                            }
                        }
                    }
                } catch (\Exception $exception) {
                    $response['message'] = $exception->getMessage();
                }
            }
        } else {
            $response['status'] = "failed";
            $response['message'] = "Username sudah digunakan gunakan username yang lain";
        }
        return $response;
    }
    public function sendMailVerivikasi(AktivasiAkunRequest $request): array
    {
        $aktivasiResponse = new AktivasiAkunResponse();
        $path_info  = $_SERVER['PATH_INFO'];
        $listOfUrl = explode("/", $path_info);
        $usernameAkunVerivication = $listOfUrl[3];
        $response = array();
        $byUsername = $this->pencariMagangRepository->findByUsername($usernameAkunVerivication);
        $id = $byUsername['body'][0]['id'];
        if ($byUsername['status'] != "oke") {
            $response['status'] = "link tidak valid";
        } else {
            try {
                $mail = new PHPMailer();  // create a new object
                $email_pengirim = "gointern.pt.6@gmail.com";
                $mail->Username = $email_pengirim;
                $mail->Password = "vxuswlzezomsuzwz";
                $mail->IsSMTP(); // enable SMTP
                $nama_pengirim = "Go intern";
                $email_penerima = $request->getEmail();
                $subjek = "Verifikasi Akun";
                $mail->Host = "smtp.gmail.com";
                $mail->Port =  465;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->setFrom($email_pengirim, $nama_pengirim);
                $mail->addAddress($email_penerima);
                $mail->Subject = $subjek;
                $expire_stamp = date('Y-m-d H:i:s', strtotime("+5 min"));
                $now_stamp = date("Y-m-d H:i:s");
                // link aktivate berdasarkan token
                $token = $byUsername['body'][0]['token'];

                $linkActivation = Url::BaseApi() . "/api/aktifasi/$usernameAkunVerivication/$token";

                $pesan = <<<HTML
                <h3>Aktivasi Akun</h3>
                <p>Hai , $usernameAkunVerivication Harap Aktivasi Akun anda dengan klik tombol dibawah ini</p>
                <p>Link Akan expired pada jam $expire_stamp </p>
                <button> 
                <a href="$linkActivation"> Klick link dibawah ini</a>
                </button>
                <br>
                <br>
                <p>Salam Manis , Go intern :) </p>
HTML;
                $aktivasiResponse->setExpired($expire_stamp);
                $pencariMagang = new PencariMagang();
                $pencariMagang->setUsername($usernameAkunVerivication);
                $updateExpaired = $this->pencariMagangRepository->updateExpaired($aktivasiResponse, $pencariMagang);
                $response['data'] = $updateExpaired;
                $response['body'] = $aktivasiResponse->getExpired();
                $mail->Body =  html_entity_decode($pesan);
                $mail->isHTML(true);
                $mail->send();
                return $response;
            } catch (\Exception $exception) {
                return $response;
            }
        }
        return $response;
    }
    public function verivikasiAkun(): array
    {
        $path_info  = $_SERVER['PATH_INFO'];
        $listOfUrl = explode("/", $path_info);
        $usernameAkunVerivication = $listOfUrl[3];
        $tokenVerivication = $listOfUrl[4];
        $response = array();
        $now_stamp = date("Y-m-d H:i:s");
        $byUsername = $this->pencariMagangRepository->findByUsername($usernameAkunVerivication);
        $tokenDb =        $byUsername['body'][0]['token'];


        if ($byUsername['status'] == "data tidak ditemukan") {
            $response['status'] = "data tidak ditemukan";
        } else {
            if ($byUsername['body'][0]['status'] == "aktif") {
                $response['status'] = 'terjadi kesalahan';
                $response['message'] = 'Akun sudah di aktivasi , silahkan login';
            } else {
                if ($tokenVerivication === $tokenDb) {
                    if ($now_stamp >= $byUsername['body'][0]['expired_token']) {
                        $response['status'] = "link expired";
                    } else {
                        $this->pencariMagangRepository->updatStatus($usernameAkunVerivication);
                        $response['status'] = 'oke';
                        $response['message'] = "berhasil aktivasi , harap login menggunakan akun anda";
                    }
                } else {
                    $response['status'] = "failed";
                    $response['message'] = "link tidak valid";
                }
            }
        }
        return $response;
    }
    public function findByUsernameLike(SearchKeyword $keyword): array
    {
        $response = array();
        $pencariMagang = new PencariMagang();
        $pencariMagang->setUsername($keyword->getKeyword());
        $resulFindByUsername = $this->pencariMagangRepository->findByUsernameLike($pencariMagang);

        if ($resulFindByUsername['status'] == "ok") {
            $response = $resulFindByUsername;
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        return $response;
    }
    public function updateData(UpdatePencariMagangRequest $request): array
    {
        $response = array();

        $model =  $this->pencariMagangRepository->findById($request->getId());
        if ($model == null) {
            $response['status'] = 'failed';
            $response['message'] = "data tidak ditemukan terjadi kesalahan";
        } else {
            // $model->getUsername() == $request->getUsername() || $model->getPassword()==$request->getPassword() || $model->getTanggalLahir() == $request->getTanggalLahir() $model->getEmail() == $request->getEmail() || $model->getIdSekolah() == $request->getId_sekolah() || $model->getNo_telp() == $request->getNo_telp() || $model->getAgama() == $request->getAgama() || $model->getCv() == $request->getCv() || $model->getResume() == $request->getResume()
            if (
                $model->getUsername() == $request->getUsername() && $model->getPassword()
                == $request->getPassword() && $model->getTanggalLahir() == $request->getTanggalLahir() && $model->getEmail() == $request->getEmail() && $model->getIdSekolah() && $request->getId_sekolah() && $model->getNo_telp() == $request->getNo_telp() && $model->getAgama() == $request->getAgama() && $model->getCv() == $request->getCv() && $model->getResume() == $request->getResume() && $model->getNama() == $request->getNama()
            ) {
                $response['status'] = 'failed';
                $response['message'] = "Tidak terjadi update data";
                //                $query = "UPDATE `pencari_magang` SET `username`=?,`password`=?,`email`=?,`id_sekolah`=?,`no_telp`=?,`agama`=?,`tanggal_lahir`=?,`token`=?,`cv`=?,`resume`=?,`status`=?,`status_magang`=?,`role`=?,`update_add`=? , `foto` = ? WHERE id = ?";
            } else {
                try {
                    $pencariMagang = new PencariMagang();
                    $pencariMagang->setUsername($request->getUsername());
                    $pencariMagang->setPassword($request->getPassword());
                    $pencariMagang->setEmail($request->getEmail());
                    $pencariMagang->setIdSekolah($request->getId_sekolah());
                    $pencariMagang->setNo_telp($request->getNo_telp());
                    $pencariMagang->setAgama($request->getAgama());
                    $pencariMagang->setTanggalLahir($request->getTanggalLahir());
                    $pencariMagang->setToken($model->getToken());
                    $pencariMagang->setCv($request->getCv());
                    $pencariMagang->setResume($request->getResume());
                    $pencariMagang->setStatus($model->getStatus());
                    $pencariMagang->setStatusMagang($model->isStatusMagang());
                    $pencariMagang->setRole($model->getRole());
                    $pencariMagang->setFoto($request->getFoto());
                    $pencariMagang->setId($request->getId());
                    if (preg_match('/\s/', $request->getUsername())) {
                        $response['status'] = 'failed';
                        $response['message'] = "Username tidak boleh mengandung spasi";
                    } else {
                        if (preg_match('~^\p{Lu}~u', $request->getUsername())) {
                            $this->pencariMagangRepository->update($pencariMagang);
                            $response['status'] = 'ok';
                            $response['message'] = "Berhasil Update data";
                        } else {
                            $response['status'] = 'failed';
                            $response['message'] = "Username harus diawali dengan huruf Kapital";
                        }
                    }
                } catch (\Exception $exception) {
                    $response['status'] = 'failed';
                    $response['message'] = ['terjadi kesalahan'];
                }
            }
        }
        return $response;
    }

    public function findById($id): ?PencariMagang
    {
        $data = $this->pencariMagangRepository->findById($id);

        return $data;
    }

    public function updateTentangSaya($tentang_saya, $id): array
    {
        $pencarimagang = new PencariMagang();
        $pencarimagang->setId($id);
        $pencarimagang->setTentang_saya($tentang_saya);
        $responsefind = $this->pencariMagangRepository->findById($id);
        if ($responsefind == null) {
            $response['status'] = "failed";
            $response['message'] = "Gagal memperbarui tentang saya";
        } else {
            $isSucces = $this->pencariMagangRepository->updateTentangSaya($pencarimagang);
            $response = array();
            if ($isSucces) {
                $response['status'] = "oke";
                $response['message'] = "berhasil memperbarui tentang saya";
            } else {
                $response['status'] = "failed";
                $response['message'] = "Gagal memperbarui tentang saya";
            }
        }
        return $response;
    }

    public function updateDeskripsi($deskripsi, $id): array
    {
        $pencariMagang = new PencariMagang();
        $pencariMagang->setId($id);
        $resultCari = $this->pencariMagangRepository->findById($id);
        $response = array();
        if ($resultCari == null) {
            $response['status'] = 'failed';
            $response['message'] = 'gagal memperbarui data sekolah';
        } else {
            $pencariMagang->setDeskripsi_sekolah($deskripsi);
            $responseUpdate = $this->pencariMagangRepository->updateDeskripsiSekolah($pencariMagang);
            if ($responseUpdate != null) {
                $response['status'] = 'oke';
                $response['message'] = 'berhasil memperbarui deskripsi sekolah';
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal memperbarui data sekolah';
            }
        }
        return $response;
    }
    public function uploadImage($username): array
    {
        $response = array();
        if (isset($_FILES['avatar'])) {
            $avatar_name = $_FILES["avatar"]["name"];
            $avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
            $error = $_FILES["avatar"]["error"];
            if ($error > 0) {
                http_response_code(400);
                $response['status'] = 'failed';
                $response['message'] =  'terjadi kesalahan upload image';
            } else {
                $nameDecoded = md5($avatar_name);
                $fotoExtensions = explode(".", $avatar_name);
                $microTime = floor(microtime(true) * 1000);
                $fullNameFoto = $microTime . rand(10, 100) . $nameDecoded . "." . $fotoExtensions[1];
                $response =  MoveFile::moveFilePenyedia($avatar_tmp_name, $fullNameFoto, 'avatarpencari');
                if ($response['status'] == 'oke') {
                    // todo update photo path in DB
                    $pencariMagang = new PencariMagang();
                    $pencariMagang->setFoto($fullNameFoto);
                    $pencariMagang->setUsername($username);
                    $responserepo = $this->pencariMagangRepository->saveImage($pencariMagang);
                    var_dump($responserepo);
                    http_response_code(200);
                } else if ($response['status'] == 'failed') {
                    $response['status'] = 'failed';
                    $response['message'] =  'Kamu tidak bisa menambahkan foto yang sama , coba rename foto mu';
                    http_response_code(404);
                } else {
                    $response['status'] = 'failed';
                    $response['message'] =  'terjadi kesalahan upload image';
                    http_response_code(400);
                }
            }
        }
        return $response;
    }
    public function addSekolah(int $sekolah, int $jurusan, $id): array
    {
        $pencariMagang = new PencariMagang();
        $sekolahResponse = $this->sekolahRepository->findById($sekolah);
        $jurusanResponse =  $this->jurusanRepository->findById($jurusan);
        $response = array();
        if ($sekolahResponse != null && $jurusanResponse != null) {
            $pencariMagang->setIdSekolah($sekolah);
            $pencariMagang->setJurusan($jurusan);
            $pencariMagang->setId($id);
            $responsePencariMagang = $this->pencariMagangRepository->findById($id);
            if ($responsePencariMagang != null) {
                $responseObj =  $this->pencariMagangRepository->addSekolah($pencariMagang);
                if ($responseObj) {
                    http_response_code(200);
                    $response['status'] = "oke";
                    $response['messge'] = "berhasil menambahkan sekolah dan jurusan";
                } else {
                    $response['status'] = "failed";
                    $response['messge'] = "gagal menambahkan sekolah dan jurusan";
                    http_response_code(400);
                }
            } else {
                http_response_code(404);
                $response['status'] = 'failed';
                $response['message'] = "gagal , data user tidak ada";
            }
        } else {
            http_response_code(404);
            $response['status'] = 'failedd';
            $response['message'] = 'data jurusan dan sekolah tidak ada';
        };
        return $response;
    }

    public function showdatasekolah($id): array
    {
        return  $this->pencariMagangRepository->showDataSekolah($id);
    }

    public function addPenghargaan($files, $judul, $username): array
    {
        define('KB', 1024);
        define('MB', 1048576);
        define('GB', 1073741824);
        define('TB', 1099511627776);
        $response = array();
        $response['body'] = array();
        $tmp_name = $files['tmp_name'];
        $name = $files['name'];
        $nameTm = explode(".", $name);
        $namebeforeConvert = $nameTm[0];
        $extensions = $nameTm[1];
        $microTime = floor(microtime(true) * 1000 + time());
        $nameTemp = $microTime . rand(10, 100) . md5($namebeforeConvert);
        $fullname = $nameTemp . "." . $extensions;
        $size = $files['size'];
        if ($files['error'] > 0) {
            http_response_code(500);
            $response['status'] = 'failed';
            $response['message'] = 'gagal menambahkan file penghargaan , terjadi kesalahan server';
        } else {
            if ($size > 5 * MB) {
                http_response_code(401);
                $response['status'] = 'failed';
                $response['message'] = 'file tidak boleh lebih dari 5 MB';
            } else {
                $responseUpload =  MoveFile::moveFilePenyedia($tmp_name, $fullname, "penghargaan");
                if ($responseUpload['status'] == 'oke') {
                    $responseByUsername = $this->pencariMagangRepository->findByUsername($username);
                    $id_penghargaanTemp = $responseByUsername['body'][0]['id_penghargaan'];
                    $id_pencarimagang = $responseByUsername['body'][0]['id'];
                    // succes move file to directory
                    $penghargaan = new Penghargaan();
                    $penghargaan->setJudul($judul);
                    $penghargaan->setFile($fullname);
                    $penghargaan->setPencari_magang($id_pencarimagang);
                    if ($responseByUsername['status'] == 'oke') {
                        if ($id_penghargaanTemp != 0) {
                            $penghargaan->setId_penghargaan($id_penghargaanTemp);
                            $responsePenghargaan = $this->penghargaanRepository->findById($penghargaan);
                            if ($responsePenghargaan != null) {
                                if (unlink(__DIR__ . "/../../public/dokuments/penghargaan/" . $responsePenghargaan->getFile())) {
                                    $penghargaan->setId_penghargaan($id_penghargaanTemp);
                                    $penghargaan->setFile($fullname);
                                    $penghargaan->setJudul($judul);
                                    $resultPenghargaan = $this->penghargaanRepository->updatePenghargaan($penghargaan);
                                    if ($resultPenghargaan) {
                                        $item = array(
                                            "id_penghargaan" => $penghargaan->getId_penghargaan(),
                                            "judul" => $penghargaan->getJudul(),
                                            "file" => $penghargaan->getFile()
                                        );
                                        array_push($response['body'], $item);
                                        http_response_code(201);
                                        $response['status'] = 'oke';
                                        $response['message'] = 'berhasil memperbarui penghargaan';
                                    } else {
                                        http_response_code(400);
                                        $response['status'] = 'failed';
                                        $response['message'] = 'gagal memperbarui penghargaan';
                                    }
                                } else {
                                    http_response_code(400);
                                    $response['status'] = 'failed';
                                    $response['message'] = 'gagal memperbarui data , data tidak ada';
                                }
                            }
                        } else {

                            $penghargaanresult =  $this->penghargaanRepository->addPenghargaan($penghargaan);
                            if ($penghargaanresult != null) {
                                if ($responseByUsername['status'] == 'oke') {
                                    $pencariMagang = new PencariMagang();
                                    $pencariMagang->setUsername($username);
                                    $result =  $this->pencariMagangRepository->addPenghargaan($pencariMagang, $penghargaanresult);
                                    if ($result) {
                                        $item = array(
                                            "id_penghargaan" => $penghargaan->getId_penghargaan(),
                                            "judul" => $penghargaan->getJudul(),
                                            "file" => $penghargaan->getFile()
                                        );
                                        http_response_code(201);
                                        array_push($response['body'], $item);
                                        $response['status'] = 'ok';
                                        $response['message'] = 'berhasil menambahkan penghargaan ke pencari magang';
                                    } else {
                                        http_response_code(400);
                                        $response['status'] = 'failed';
                                        $response['message'] = 'gagal menambahkan penghargaan ke pencari magang';
                                    }
                                }
                            } else {
                                http_response_code(400);
                                $response['status'] = 'failed';
                                $response['message'] = 'gagak menambahkan penghargaan ke table penghargaan';
                            }
                        }
                    } else {
                        $response['status'] = 'failed';
                        $response['message'] = 'data user tidak ada harap masukan username yang tersedia';
                    }
                } else {
                }
            }
        }
        return $response;
    }

    public function updateDataPersonal($nama, $email, $tanggal_lahir, $agama, $jenis_kelamin, $id): array
    {
        $pencariMagang = new PencariMagang();
        $pencariMagang->setNama($nama);
        $pencariMagang->setEmail($email);
        $pencariMagang->setTanggalLahir($tanggal_lahir);
        $pencariMagang->setAgama($agama);
        $pencariMagang->setJenis_kelamin($jenis_kelamin);
        $pencariMagang->setId($id);
        $response = array();
        $responseFindById =  $this->pencariMagangRepository->findById($id);
        if ($responseFindById != null) {
            if ($responseFindById->getNama() == $nama && $responseFindById->getEmail() == $email && $responseFindById->getTanggalLahir() == $tanggal_lahir && $responseFindById->getAgama() == $agama && $responseFindById->getJenis_kelamin() == $jenis_kelamin) {
                http_response_code(401);
                $response['status'] = 'failed';
                $response['message'] = 'gagal memperbarui data tidak ada perubahan';
            } else {
                $responseUpdate =  $this->pencariMagangRepository->updateDataPersonal($pencariMagang);
                if ($responseUpdate != null) {
                    http_response_code(200);
                    $response['status'] = 'oke';
                    $response['message'] = 'berhasil update data user';
                } else {
                    http_response_code(500);
                    $response['status'] = 'failed';
                    $response['message'] = 'gagal memperbarui user , terjadi kesalahan';
                }
            }
        } else {
            http_response_code(404);
            $response['status'] = 'failed';
            $response['message'] = 'gagal menemukan data user';
        }
        return $response;
    }
    public function updateKeamann($username, $password, $id): array
    {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $pencariMagang = new PencariMagang();
        $pencariMagang->setUsername($username);
        $pencariMagang->setPassword($hashed);
        $pencariMagang->setId($id);
        $response = array();
        $responseFindById = $this->pencariMagangRepository->findById($id);
        if ($responseFindById != null) {
            if (password_verify($password, $responseFindById->getPassword()) && $username == $responseFindById->getUsername()) {
                http_response_code(401);
                $response['status'] = 'failed';
                $response['message'] = 'gagal memperbarui Data Keamanan , tidak ada perubahan';
            } else {
                $responseUpdate =  $this->pencariMagangRepository->updateKeamanan($pencariMagang);
                if ($responseUpdate != null) {
                    http_response_code(200);
                    $response['status'] = 'oke';
                    $response['message'] = "berhasil memperbarui keamanan user";
                } else {
                    http_response_code(400);
                    $response['status'] = 'failed';
                    $response['message'] = 'gagal memperbarui kemanan user ';
                }
            }
        } else {
            http_response_code(404);
            $response['status'] = 'failed';
            $response['message'] = 'data user tidak ditemukan';
        }
        return $response;
    }

    public function updateCv($files, $username): array
    {
        $response = array();
        $response['body'] = array();
        $tmp_name = $files['tmp_name'];
        $name = $files['name'];
        $nameTm = explode(".", $name);
        $namebeforeConvert = $nameTm[0];
        $extensions = $nameTm[1];
        $microTime = floor(microtime(true) * 1000 + time());
        $nameTemp = $microTime . rand(10, 100) . md5($namebeforeConvert);
        $fullname = $nameTemp . "." . $extensions;
        $pencariMagang = new PencariMagang();
        $pencariMagang->setCv($fullname);
        $pencariMagang->setUsername($username);
        $responseFindById = $this->pencariMagangRepository->findByUsername($username); // salah , nanti 
        $pencariMagangFind = new PencariMagang();
        $pencariMagangFind->setUsername($username);
        $responseFindCv =  $this->pencariMagangRepository->findCvByUsername($pencariMagangFind);

        if ($responseFindById['status'] == 'oke') {
            if ($responseFindCv->getCv() != "belum ada cv") {
                // ada data cv di dalam server , delete
                if (unlink(__DIR__ . "/../../public/dokuments/cv/" . $responseFindCv->getCv())) {
                    $responseMove = MoveFile::moveFilePenyedia($tmp_name, $fullname, "cv");
                    $responseUpdate = $this->pencariMagangRepository->updateCv($pencariMagang);
                    if ($responseUpdate != null) {
                        http_response_code(200);
                        $response['status'] = 'oke';
                        $response['message'] = 'berhasil menambahkan cv';
                    } else {
                        http_response_code(400);
                        $response['status'] = 'failed';
                        $response['message'] = 'gagal menabahkan cv terjadi kesalahan';
                    }
                } else {
                    $responseMove = MoveFile::moveFilePenyedia($tmp_name, $fullname, "cv");
                    $responseUpdate = $this->pencariMagangRepository->updateCv($pencariMagang);
                    if ($responseUpdate != null) {
                        http_response_code(200);
                        $response['status'] = 'oke';
                        $response['message'] = 'berhasil menambahkan cv , tetapi gagal melakukan delete di server';
                    } else {
                        http_response_code(400);
                        $response['status'] = 'failed';
                        $response['message'] = 'gagal menabahkan cv terjadi kesalahan';
                    }
                }
            } else {
                $responseMove = MoveFile::moveFilePenyedia($tmp_name, $fullname, "cv");
                if ($responseFindById['status'] == "oke") {
                    $responseUpdate = $this->pencariMagangRepository->updateCv($pencariMagang);
                    if ($responseUpdate != null) {
                        http_response_code(200);

                        var_dump($responseMove);
                        $response['status'] = 'oke';
                        $response['message'] = 'berhasil menambahkan cv';
                    } else {
                        http_response_code(400);
                        $response['status'] = 'failed';
                        $response['message'] = 'gagal menabahkan cv terjadi kesalahan';
                    }
                } else {
                    http_response_code(404);
                    $response['status'] = 'failed';
                    $response['message'] = 'gagal menambahkan cv ,data tidak ditemukan';
                }
            }
        } else {
            http_response_code(404);
            $response['status'] = 'failed';
            $response['message'] = 'gagal menambahkan cv , data user tidak ditemukan';
        }
        return $response;
    }

    public function updateNoHp($noHp, $id)
    {
        $responseBool = $this->pencariMagangRepository->updateNoHp($noHp, $id);
        $response = array();

        if ($responseBool) {
            http_response_code(200);
            $response['status'] = 'success';
            $response['message'] = 'berhasil memperbarui no telpeon';
        } else {
            http_response_code(400);
            $response['status'] = 'failed';
            $response['message'] = 'gagal memperbarui no telpon';
        }
        return $response;
    }

    public function showMagangActive($id): array
    {
        $response = $this->pencariMagangRepository->showMagangActive($id);
        if ($response['status'] == 'oke') {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        return $response;
    }

    public function enable($id): array
    {

        $response = [];
        $result = $this->pencariMagangRepository->findById($id);
        if ($result != null) {
            $responseEnabled =  $this->pencariMagangRepository->enable($id);
            if ($responseEnabled) {
                $response['status'] = 'oke';
                $response['message'] = 'berhasil mengaktifkan user / pencari magang';
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal mengaktifkan user terjadi kesalahan server';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'data pencari magang tidak ditemukan';
        }

        return $response;
    }

    public function disable($id): array
    {
        $response = [];
        $result = $this->pencariMagangRepository->findById($id);
        if ($result != null) {
            $responseEnabled =  $this->pencariMagangRepository->disable($id);
            if ($responseEnabled) {
                $response['status'] = 'oke';
                $response['message'] = 'berhasil Menonaktifkan user / pencari magang';
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal Menonaktifkan user terjadi kesalahan server';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'data pencari magang tidak ditemukan';
        }

        return $response;
    }

    public function showRiwayatlamaran($id): array
    {
        return $this->pencariMagangRepository->showRiwayatLamaran($id);
    }
}
