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
        return $this->pencariMagangRepository->findAll();
    }
    public function login(LoginRequest $loginRequest): array
    {
        $loginResponse = $this->pencariMagangRepository->findByUsername($loginRequest->username);
        $response = array();
        $response['body'] = array();
        if ($loginResponse['status'] == 'oke') {
            //
            if ($loginResponse['length'] = 1) {
                //                user hanya satu
                if ($loginRequest->password == $loginResponse['body'][0]['password']) {
                    //                    cek hash
                    $response['message'] = "Berhasil login";
                    array_push($response['body'], $loginResponse);
                } else {
                    http_response_code(401);
                    $response['status'] = "failed";
                    $response['message'] = "Gagal Login , harap check password atau username anda";
                }
            }
        } else {
            $response['status'] = $loginResponse['status'];
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
                        $pencariMagang->setStatus("aktif");
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
                    $request->getNamaBelakang() == null || $request->getNamaDepan() == null || $request->getIdSekolah() == null
                ) {
                    // Todo , send message null
                    http_response_code(400);
                    $response['status'] = "failed";
                    $response['message'] = "harap isi semua field";
                } else {
                    if (
                        $request->getUsername() == "" || $request->getPassword() == "" || $request->getEmail() == ""  ||
                        $request->getNamaBelakang() == "" || $request->getNamaDepan() == "" || $request->getIdSekolah() == ""
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
                        $pencariMagang->setTanggalLahir($request->getTanggalLahir());
                        $pencariMagang->setToken($request->getToken());
                        $pencariMagang->setStatus("tidak_aktif");
                        $pencariMagang->setStatusMagang("tidak_magang");
                        $pencariMagang->setRole($request->getRole());
                        $sekolah->id = $request->getIdSekolah();
                        $pencariMagang->setIdSekolah($request->getIdSekolah());
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

    public function activateAkun(AktivasiAkunRequest $request): array
    {
        $byUsername = $this->pencariMagangRepository->findByUsername($request->getUsername());
        $response = array();
        if ($byUsername['status'] == "data tidak ditemukan") {
            // data tidak ada
            http_response_code(404);
            $response['status'] = "username tidak terdaftar";
        } else {
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
                $mail->SMTPDebug = 2;
                $mail->setFrom($email_pengirim, $nama_pengirim);
                $mail->addAddress($email_penerima);
                $mail->Subject = $subjek;
                $expire_stamp = date('Y-m-d H:i:s', strtotime("+5 min"));
                $now_stamp = date("Y-m-d H:i:s");

                $linkActivation = Url::BaseUrl() . "/api/aktifasi/$usernameAkunVerivication";
                $pesan = <<<HTML
                <h3>Aktivasi Akun</h3>
                <p>Harap Aktivasi Akun anda dengan klcik button dibawah</p>
                <p>Link Akan expired pada jam $expire_stamp </p>
                <button type="submit"><a href="$linkActivation">Aktivasi Akun</a></button>
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
        $response = array();
        $now_stamp = date("Y-m-d H:i:s");
        $byUsername = $this->pencariMagangRepository->findByUsername($usernameAkunVerivication);

        if ($byUsername['status'] == "data tidak ditemukan") {
            $response['status'] = "data tidak ditemukan";
        } else {
            if ($now_stamp >= $byUsername['body'][0]['expired_token']) {
                $response['status'] = "link expired";
            } else {
                $this->pencariMagangRepository->updatStatus($usernameAkunVerivication);
                $response['status'] = "berhasil update";
            }
        }
        return $response;
    }
}
