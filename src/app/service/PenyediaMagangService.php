<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\PenyediaMagang;
use LearnPhpMvc\dto\AktivasiAkunRequest;
use LearnPhpMvc\dto\AktivasiAkunResponse;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\RegisterPenyediaRequest;
use LearnPhpMvc\repository\PenyediaMagangRepository;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;

class PenyediaMagangService
{

    private PenyediaMagangRepository $repository;

    public function __construct()
    {
        $this->repository = new PenyediaMagangRepository(Database::getConnection());
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }


    public function register(RegisterPenyediaRequest $registerPenyediaRequest): array
    {
        $reponse = array();
        try {
            //code...
            $domain = new PenyediaMagang();
            $domain->setUsername($registerPenyediaRequest->getUsername()); // 
            $domain->setPassword($registerPenyediaRequest->getPassword()); // 
            $domain->setEmail($registerPenyediaRequest->getEmail()); // 
            $domain->setNamaPerushaan($registerPenyediaRequest->getNama_perusahaan()); //
            $domain->setNoTelp($registerPenyediaRequest->getNo_telp()); // 
            $domain->setRole($registerPenyediaRequest->getRole());
            $domain->setToken($registerPenyediaRequest->getToken());

            if ($domain->getUsername() != null && $domain->getPassword() != null && $domain->getEmail() != null && $domain->getNamaPerushaan() != null && $domain->getNoTelp() != null && $domain->getRole() != null && $domain->getToken() != null) {
                if (
                    $domain->getUsername() != "" && $domain->getPassword() != "" && $domain->getEmail() != "" && $domain->getNamaPerushaan() != "" && $domain->getNoTelp() != "" && $domain->getRole() != "" && $domain->getToken()
                ) {
                    http_response_code(200);
                    $this->repository->save($domain);
                    $item = array(
                        "id" => $domain->getId(),
                        "nama_perusahaan" => $domain->getNamaPerushaan(),
                        "username" => $domain->getUsername(),
                        "password" => $domain->getPassword(),
                        "email" => $domain->getEmail(),
                        "no_telp" => $domain->getNoTelp(),
                        "role" => $domain->getRole(),
                        "token" => $domain->getToken(),
                        "status" => $domain->getStatus()
                    );
                    $reponse['status'] = 'ok';
                    $reponse['message'] = 'berhasil regristasi';
                    array_push($reponse, $item);
                } else {
                    http_response_code(400);
                    $reponse['status'] = 'failed';
                    $reponse['message'] = 'harap isi semua field';
                }
            } else {
                http_response_code(401);
                $reponse['status'] = 'failed';
                $reponse['message'] = 'Semua field tidak boleh null';
            }
            return $reponse;
        } catch (PDOException $th) {
            //throw $th; 
            http_response_code(500);
            return $reponse;
        }
    }
    // find penyedia magang by username
    public function findByUsername($username): array
    {
        $request = new PenyediaMagang();
        $request->setUsername($username);
        $response = $this->repository->findByUsername($request);
        return $response;
    }
    // send email after regristation
    public function sendMailVerivikasi(AktivasiAkunRequest $request): array
    {
        $aktivasiResponse = new AktivasiAkunResponse();
        $path_info = $_SERVER['PATH_INFO'];
        $listOfUrl = explode("/", $path_info);
        $usernameAkunVerivication = $listOfUrl[4];

        $response = array();
        $penyediaMagang = new PenyediaMagang();
        $penyediaMagang->setUsername($usernameAkunVerivication);
        $byUsername = $this->repository->findByUsername($penyediaMagang);
        if ($byUsername == null) {
            $response['status'] = "link tidak valid";
            http_response_code(404);
        } else {
            try {
                // konfigurasi mail stmpt
                $mail = new PHPMailer(); // create a new object
                $email_pengirim = "mohammadtajutzamzami07@gmail.com";
                $mail->Username = $email_pengirim;
                $mail->Password = "coskgmkmkonrchpy";
                $mail->IsSMTP(); // enable SMTP
                $nama_pengirim = "Go intern";
                $email_penerima = $request->getEmail();
                $subjek = "Verifikasi Akun";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                // $mail->SMTPDebug = 2;
                $mail->setFrom($email_pengirim, $nama_pengirim);
                $mail->addAddress($email_penerima);
                $mail->Subject = $subjek;
                $expire_stamp = date('Y-m-d H:i:s', strtotime("+5 min"));
                $now_stamp = date("Y-m-d H:i:s");
                // link aktivate berdasarkan token
                $token = $byUsername[0]['token'];
                $linkActivation = Url::BaseApi() . "/api/aktifasi/penyedia/$usernameAkunVerivication/$token";
                $pesan = <<<HTML
                <h3>Hai , $usernameAkunVerivication Harap Aktivasi Akun anda dengan klik tombol dibawah ini</h3>
                <p>Harap Aktivasi Akun anda dengan klik tombol dibawah ini</p>
                <p>Link Akan expired pada jam $expire_stamp </p>
                <button> 
                <a href="$linkActivation"> Klick link dibawah ini</a>
                </button>
                <br>
                <br>
                <p>Salam Manis , Go intern :) </p>
HTML;
                $aktivasiResponse->setExpired($expire_stamp);
                $pencariMagang = new PenyediaMagang();
                $pencariMagang->setUsername($usernameAkunVerivication);
                $updateE = $this->repository->updateExpaired($aktivasiResponse, $penyediaMagang);
                $response['data'] = $updateE;
                $response['body'] = $aktivasiResponse->getExpired();
                $mail->Body = html_entity_decode($pesan);
                $mail->isHTML(true);
                $mail->send();
                http_response_code(200);
                return $response;
            } catch (\Exception $exception) {
                return $response;
            }
        }
        return $response;
    }
    // update status user , after click link in email
    public function updateStatusUser(): array
    {
        $path_info = $_SERVER['PATH_INFO'];
        $listOfUrl = explode("/", $path_info);
        $usernameAkunVerivication = $listOfUrl[4];
        $tokenVerivication = $listOfUrl[5];

        $response = array();
        $now_stamp = date("Y-m-d H:i:s");
        $penyediaMagang = new PenyediaMagang();
        $penyediaMagang->setUsername($usernameAkunVerivication);
        $byUsername = $this->repository->findByUsername($penyediaMagang);

        $tokenDb = $byUsername[0]['token'];

        if ($byUsername['status'] == "data tidak ditemukan") {
            http_response_code(404);
            $response['status'] = "data tidak ditemukan";
        } else {
            if ($byUsername[0]['status'] == "aktif") {
                http_response_code(201);
                $response['status'] = 'terjadi kesalahan';
                $response['message'] = 'Akun sudah di aktivasi , silahkan login';
            } else {
                if ($tokenVerivication === $tokenDb) {
                    http_response_code(401);
                    if ($now_stamp >= $byUsername[0]['expired_token']) {
                        $response['status'] = "link expired";
                    } else {
                        http_response_code(200);
                        $this->repository->updateStatus($penyediaMagang);
                        $response['status'] = "berhasil aktivasi , harap login menggunakan akun anda";
                    }
                } else {
                    http_response_code(400);
                    $response['status'] = "failed";
                    $response['message'] = "link tidak valid";
                }
            }
        }
        return $response;
    }
    public function login(LoginRequest $loginRequest): array
    {
        $penyediaMagang = new PenyediaMagang();
        $penyediaMagang->setUsername($loginRequest->username);
        $response = array();
        $responseByUsername = $this->repository->findByUsername($penyediaMagang);
        if ($responseByUsername['status'] == "oke") {
            if ($responseByUsername[0]['status'] == "tidak-aktif") {
                http_response_code(401);
                $response['status'] = 'Failed';
                $response['message'] = "Harap Aktivasi akun anda terlebih dahulu";
            } else if (password_verify($loginRequest->password, $responseByUsername[0]['password'])) {
                http_response_code(200);
                $response['status'] = 'oke';
                $response['message'] = 'berhasil login';
                array_push($response, $responseByUsername[0]);
            } else {
                http_response_code(401);
                $response['status'] = 'failed';
                $response['message'] = 'username atau password salah';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'harap cek username atau password anda';
        }
        return $response;
    }
}
