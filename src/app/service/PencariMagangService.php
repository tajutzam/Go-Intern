<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\Sekolah;
use LearnPhpMvc\dto\AktivasiAkunRequest;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\RegisterPencariMagangRequest;
use LearnPhpMvc\repository\PencariMagangRepository;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

use PHPUnit\TextUI\XmlConfiguration\Php;

class PencariMagangService
{

    private PencariMagangRepository $pencariMagangRepository;
    
    /**
     * @param PencariMagangRepository $pencariMagangRepository
     */
    public function __construct(PencariMagangRepository $pencariMagangRepository)
    {
        $this->pencariMagangRepository = $pencariMagangRepository;
    }
    public function findAll() : array {
        return $this->pencariMagangRepository->findAll();
    }
    public function login(LoginRequest $loginRequest) : array{
        $loginResponse = $this->pencariMagangRepository->findByUsername($loginRequest->username);
        $response = array();
        $response['body'] = array();
        if($loginResponse['status'] == 'oke'){
//
            if($loginResponse['length']=1){
//                user hanya satu
                if($loginRequest->password == $loginResponse['body'][0]['password']){
//                    cek hash
                    $response['message'] = "Berhasil login";
                    array_push($response['body'] , $loginResponse);
                }else{
                    http_response_code(401);
                    $response['status'] = "failed";
                    $response['message'] = "Gagal Login , harap check password atau username anda";
                }
            }
        }else{
            $response['status'] = $loginResponse['status'];
        }
        return $response;
    }
    public function register(RegisterPencariMagangRequest $request) : array {
        $response = array();
        $response['body'] = array();
        if($request->getRole() == 1){
            // admin
        }else if($request->getRole()==2){
            // penyedia
        }else if($request->getRole()==3){
            // pencari magang
            // todo pencari magang request
            try {
                if($request->getUsername() == null || $request->getPassword() == null || $request->getEmail() ==null || $request->getCv() == null || $request->getResume() == null ||
                    $request->getAlamat() == null || $request->getNamaBelakang()== null || $request->getNamaDepan()==null|| $request->getSkill()==null || $request->getIdSekolah()==null
                ){
                    // Todo , send message null
                    http_response_code(400);
                    $response['status']="failed";
                    $response['message'] = "harap isi semua field";
                }else{
                    if($request->getUsername() == "" || $request->getPassword() == "" || $request->getEmail() =="" || $request->getCv() == "" || $request->getResume() == "" ||
                        $request->getAlamat() == "" || $request->getNamaBelakang()== "" || $request->getNamaDepan()== ""|| $request->getSkill()==""
                    ){
                        http_response_code(400);
                        $response['status'] = "failed";
                        $response['message'] = "harap isi semua field";
                    }else{
                        $date = \date("Y-m-d");
                        $pencariMagang = new PencariMagang();
                        $sekolah = new Sekolah();
                        $pencariMagang->setUsername($request->getUsername());
                        $pencariMagang->setPassword($request->getPassword());
                        $pencariMagang -> setEmail($request->getEmail());
                        $pencariMagang->setNo_telp($request->getNotelp());
                        $pencariMagang ->setAgama($request->getAgama());
                        $pencariMagang -> setTanggalLahir($date);
                        $pencariMagang->setToken($request->getToken());
                        $pencariMagang -> setCv($request->getCv());
                        $pencariMagang -> setResume($request->getResume());
                        $pencariMagang -> setStatus("aktif");
                        $pencariMagang -> setStatusMagang("tidak_magang");
                        $pencariMagang -> setRole($request->getRole());
                        $pencariMagang->setFoto($request->getFoto());
                        $sekolah->id = $request->getIdSekolah();
                        $pencariMagang->setNama($request->getNamaDepan()." ".$request->getNamaBelakang());
                        $saveResult = $this->pencariMagangRepository->save($pencariMagang, $sekolah);
                        if($saveResult == null){
                            http_response_code(401);
                            $response['status'] ="failed";
                            $response['status'] = "terjadi kesalahan";
                        }else{
                            $items = array(
                                "username" => $request->getUsername() ,
                                "password" => $request->getPassword() ,
                                "email" => $request -> getEmail() ,
                                "no_telp" => $request->getNotelp() ,
                                "agama" => $request->getAgama() ,
                                "tanggal_lahir" => $pencariMagang->getTanggalLahir() ,
                                "token" => $request->getToken() ,
                                "cv" =>$request->getCv(),
                                "resume" => $request->getResume(),
                                "status" => $pencariMagang->getStatus() ,
                                "status_magang" => $pencariMagang->isStatusMagang() ,
                                "role" => $request->getRole() ,
                                "foto" => $request->getFoto() ,
                                "sekolah" => $request->getIdSekolah() ,
                                "nama" => $pencariMagang->getNama()
                            );
                            array_push($response['body'] , $items);
                            $response['status'] = "oke";
                            $response['message'] = "berhasil regristasi";
                        }
                    }
                }
            }catch (\Exception $exception){
                $response['message'] = $exception->getMessage();
            }
        }
        return $response;
    }
    public function findByUsername($username) : array{
        $byUsername = $this->pencariMagangRepository->findByUsername($username);
        return $byUsername;
    }
    public function registerMobile(RegisterPencariMagangRequest $request) : array {
        $response = array();
        $response['body'] = array();
        if($request->getRole() == 1){
            // admin
        }else if($request->getRole()==2){
            // penyedia
        }else if($request->getRole()==3){
            // pencari magang
            // todo pencari magang request
            try {
                if($request->getUsername() == null || $request->getPassword() == null || $request->getEmail() ==null  ||
                    $request->getNamaBelakang() == null || $request->getNamaDepan() ==null || $request->getIdSekolah()==null
                ){
                    // Todo , send message null
                    http_response_code(400);
                    $response['status']="failed";
                    $response['message'] = "harap isi semua field";
                }else{
                    if($request->getUsername() == "" || $request->getPassword() == "" || $request->getEmail() ==""  ||
                        $request->getNamaBelakang() == "" || $request->getNamaDepan() =="" || $request->getIdSekolah()==""
                    ){
                        http_response_code(400);
                        $response['status'] = "failed";
                        $response['message'] = "harap isi semua field";
                    }else{
                        $date = \date("Y-m-d");
                        $pencariMagang = new PencariMagang();
                        $sekolah = new Sekolah();
                        $pencariMagang->setUsername($request->getUsername());
                        $pencariMagang->setPassword($request->getPassword());
                        $pencariMagang -> setEmail($request->getEmail());
                        $pencariMagang -> setTanggalLahir($request->getTanggalLahir());
                        $pencariMagang->setToken($request->getToken());
                        $pencariMagang -> setStatus("tidak_aktif");
                        $pencariMagang -> setStatusMagang("tidak_magang");
                        $pencariMagang -> setRole($request->getRole());
                        $sekolah->id = $request->getIdSekolah();
                        $pencariMagang->setIdSekolah($request->getIdSekolah());
                        $pencariMagang->setNama($request->getNamaDepan()." ".$request->getNamaBelakang());
                        $saveResult = $this->pencariMagangRepository->savePencariMagnag($pencariMagang, $sekolah);
                        if($saveResult == null){
                            http_response_code(401);
                            $response['status'] ="failed";
                            $response['status'] = "terjadi kesalahan";
                        }else{
                            $items = array(
                                "username" => $request->getUsername() ,
                                "password" => $request->getPassword() ,
                                "email" => $request -> getEmail() ,
                                "tanggal_lahir" => $pencariMagang->getTanggalLahir() ,
                                "token" => $request->getToken() ,
                                "status" => $pencariMagang->getStatus() ,
                                "status_magang" => $pencariMagang->isStatusMagang() ,
                                "role" => $request->getRole()  ,
                                "sekolah" => $request->getIdSekolah() ,
                                "nama" => $pencariMagang->getNama()
                            );
                            array_push($response['body'] , $items);
                            $response['status'] = "oke";
                            $response['message'] = "berhasil regristasi";
                        }
                    }
                }
            }catch (\Exception $exception){
                $response['message'] = $exception->getMessage();
            }
        }
        return $response;
    }

    public function activateAkun(AktivasiAkunRequest $request) : array {
        $byUsername = $this->pencariMagangRepository->findByUsername($request->getUsername());
        $response = array();
        if($byUsername['status'] == "data tidak ditemukan"){
            // data tidak ada
            http_response_code(404);
            $response['status'] = "username tidak terdaftar";
        }else{

        }
        return $response;
    }
    public function VerivikasiAccount(AktivasiAkunRequest $request) : array {

        $response = array();
            global $error;
            $mail = new PHPMailer();  // create a new object
            $mail->IsSMTP(); // enable SMTP
            $email_pengirim = "mohammadtajutzamzami07@gmail.com";
            $nama_pengirim = "Go intern";
            $email_penerima = $request->getEmail();
            $subjek = "test";
            $pesan = "Harap aktifasi akun anda , dengan klick link berikut <a> klick disini sayang </a>";
            $mail->Host="smtp.gmail.com";
            $mail->Username = $email_pengirim;
            $mail->Password = "bhcysdyzkslqvagg";
            $mail->Port =  465;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPDebug = 2;
            $mail->setFrom($email_pengirim  , $nama_pengirim);
            $mail->addAddress($email_penerima);
            $mail->Subject = $subjek;
            $sendMail = $mail->send();
            $mail->isHTML();
            $mail->Body = $pesan;
            if($sendMail){
              http_response_code(200);
              $response['status'] = 'oke';
              $response['message'] = 'Sukses Aktifasi akun';
            }else{
              http_response_code(400);
              $response['status'] = 'failed';
              $response['message'] = 'Gagal Aktifasi akun';
            }
        return $response;
    }

}