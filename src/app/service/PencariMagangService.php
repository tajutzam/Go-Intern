<?php

namespace LearnPhpMvc\service;

use Cassandra\Date;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\Sekolah;
use LearnPhpMvc\dto\AktivasiAkunRequest;
use LearnPhpMvc\dto\AktivasiAkunResponse;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\RegisterPencariMagangRequest;
use LearnPhpMvc\dto\SearchKeyword;
use LearnPhpMvc\dto\UpdateOencariMagangRequest;
use LearnPhpMvc\dto\UpdatePencariMagangRequest;
use LearnPhpMvc\repository\PencariMagangRepository;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

use PHPUnit\TextUI\XmlConfiguration\Php;

class PencariMagangService
{
    private PencariMagangRepository $pencariMagangRepository;

    public function __construct(PencariMagangRepository $pencariMagangRepository)
    {
        $this->pencariMagangRepository = $pencariMagangRepository;
    }
    public function findAll(): array
    {
        // return array , cek di repository package
        return $this->pencariMagangRepository->findAll();
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
                                    //                                    $sekolah->id = $request->getIdSekolah();
                                    //                                    $pencariMagang->setIdSekolah($request->getIdSekolah());
                                    $pencariMagang->setNama($request->getNamaDepan() . " " . $request->getNamaBelakang());
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
                $email_pengirim = "mohammadtajutzamzami07@gmail.com";
                $mail->Username = $email_pengirim;
                $mail->Password = "coskgmkmkonrchpy";
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
                        $response['status'] = "berhasil aktivasi , harap login menggunakan akun anda";
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
        $data =  $this->pencariMagangRepository->findById($id);
        return $data;
    }
}
