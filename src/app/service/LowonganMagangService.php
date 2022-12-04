<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\LowonganMagang;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\repository\LowonganMagangRepository;
use LearnPhpMvc\repository\MagangRepository;
use LearnPhpMvc\repository\PencariMagangRepository;
use LearnPhpMvc\repository\PenyediaMagangRepository;
use PHPMailer\PHPMailer\PHPMailer;

class LowonganMagangService
{

    private LowonganMagangRepository $repository;
    private MagangRepository $repositoryMagang;

    private PenyediaMagangRepository $repositoryPenyedia;

    private PencariMagangRepository $repositoryPencariMagang;

    private LowonganMagangRepository $repositoryLowonganMagang;

    public function __construct()
    {
        $this->repositoryPencariMagang = new PencariMagangRepository(Database::getConnection());
        $this->repositoryPenyedia = new PenyediaMagangRepository(Database::getConnection());
        $this->repository = new LowonganMagangRepository(Database::getConnection());
        $this->repositoryMagang = new MagangRepository(Database::getConnection());
        $this->repositoryLowonganMagang = new LowonganMagangRepository(Database::getConnection());
    }

    public function addLowongan($id_magang, $id_pencariMagang, $id_penyediaMagang): array
    {
        $response = array();
        $lowongan = new LowonganMagang();
        $lowongan->setId_magang($id_magang);
        $lowongan->setId_pencariMagang($id_pencariMagang);
        $lowongan->setId_penyediaMagang($id_penyediaMagang);
        $responseFindMagang = $this->repositoryMagang->findById($id_magang);
        if ($responseFindMagang) {
            $responseFindByPenyedia =  $this->repositoryPenyedia->findById($id_penyediaMagang);
            if ($responseFindByPenyedia != null) {
                $responseFindPencari = $this->repositoryPencariMagang->findById($id_pencariMagang);
                if ($responseFindPencari != null) {
                    $responseCheck = $this->repositoryLowonganMagang->checkIfExist($id_pencariMagang, $id_magang);
                    if ($responseCheck) {
                        $responseLowongan = $this->repository->addLowonganMagang($lowongan);
                        if ($responseLowongan != null) {
                            $this->repositoryLowonganMagang->updateToPending($responseLowongan->getId());
                            http_response_code(200);
                            $response['status'] = 'success';
                            $response['message'] = 'Lowongan magang berhasil dikirim';
                        } else {
                            http_response_code(404);
                            $response['status'] = 'failed';
                            $response['message'] = 'gagal mengirim lowongan magang terjadi kesalahan';
                        }
                    } else {
                        http_response_code(400);
                        $response['status'] = 'failed';
                        $response['message'] = 'Kamu sudah melamar ke posisi ini';
                    }
                } else {
                    http_response_code(404);
                    $response['status'] = 'failed';
                    $response['message'] = 'data pencari magang tidak ditemukan';
                }
            } else {
                http_response_code(404);
                $response['status'] = 'failed';
                $response['message'] = 'data Penyedia tidak ditemukan';
            }
        } else {
            http_response_code(404);
            $response['status'] = 'failed';
            $response['message'] = 'data magang tidak ditemukan';
        }
        return $response;
    }

    public function sendEmailLamaran($id_penyedia, $id_pencariMagang, $idMagang): bool
    {
        $responsePenyedia = $this->repositoryPenyedia->findById($id_penyedia);
        if ($responsePenyedia != null) {
            $responsePencari = $this->repositoryPencariMagang->findById($id_pencariMagang);
            if ($responsePencari != null) {
                $responseMagang = $this->repositoryMagang->findByIdResult($idMagang);
                if ($responseMagang != null) {
                    $mail = new PHPMailer();  // create a new object
                    $email_pengirim = "mohammadtajutzamzami07@gmail.com";
                    $mail->Username = $email_pengirim;
                    $mail->Password = "coskgmkmkonrchpy";
                    $mail->IsSMTP(); // enable SMTP
                    $nama_pengirim = $responsePencari->getNama();
                    $email_penerima = $responsePenyedia->getEmail();
                    $subjek = "Notifikasi lamaran Magang";
                    $mail->Host = "smtp.gmail.com";
                    $mail->Port =  465;
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'ssl';
                    $mail->setFrom($email_pengirim, $nama_pengirim);
                    $mail->addAddress($email_penerima);
                    $mail->Subject = $subjek;
                    $namaPerusahann = $responsePenyedia->getNamaPerushaan();
                    $posisi = $responseMagang->getPosisi_magang();
                    $datenow = date("Y/m/d");
                    $pesan = <<<HTML
                            <h3>Notifikasi Lamaran Magang dari $nama_pengirim</h3>
                            <p>Halo , $namaPerusahann Terdapat lamaran untuk posisi $posisi</p>
                            <p>Pihak Pelamar melakukan lamaran pada : $datenow </p>
                            <p> Harap check lamaran di website Resmi go Intern </p>
                            <br>
                            <br>
                            <p>Salam Manis , Go intern :) </p>
            HTML;
                    $mail->Body =  html_entity_decode($pesan);
                    $mail->isHTML(true);
                    $result =  $mail->send();
                    if ($result) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateSuratLamaran($suratLamaram, $id_magang): array
    {
        $response = array();
        $responseBool =  $this->repositoryPencariMagang->updateSuratLamaran($suratLamaram, $id_magang);
        if ($responseBool) {
            http_response_code(200);
            $response['status'] = 'success';
            $response['message'] = 'berhasil memperbaru surat lamaran';
        } else {
            http_response_code(400);
            $response['status'] = 'failed';
            $response['message'] = 'gagal memperbarui surat lamaran';
        }
        return $response;
    }

    public function showLamaranMagang($id_penyedia)
    {
        $response =  $this->repository->showLamaranByPenyedia($id_penyedia);
        return $response;
    }

    public function tolakLamaran($pencariMagang, $idMagang, $id_penyedia): array
    {
        $response = array();
        $responseFindPencariMagang = $this->repositoryPencariMagang->findById($pencariMagang);
        $responsePenyedia = $this->repositoryPenyedia->findById($id_penyedia);
        if ($responsePenyedia != null) {
            if ($responseFindPencariMagang != null) {
                $responseFindMagangAsObj = $this->repositoryMagang->findByIdResult($idMagang);
                if ($responseFindMagangAsObj != null) {
                    $lowongan = new LowonganMagang();
                    $lowongan->setId_pencariMagang($pencariMagang);
                    $lowongan->setId_magang($idMagang);
                    $responseTolak =  $this->repository->tolakLamaran($lowongan);
                    if ($responseTolak) {
                        // todo send email , to pencari magang
                        $mail = new PHPMailer();  // create a new object
                        $email_pengirim = "mohammadtajutzamzami07@gmail.com";
                        $mail->Username = $email_pengirim;
                        $mail->Password = "coskgmkmkonrchpy";
                        $mail->IsSMTP(); // enable SMTP
                        $nama_pengirim =  "Go intern";
                        $email_penerima = $responseFindPencariMagang->getEmail();
                        $nama_penerima = $responseFindPencariMagang->getNama();
                        $subjek = "Notifikasi , Lamaran Magang";
                        $mail->Host = "smtp.gmail.com";
                        $mail->Port =  465;
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = 'ssl';
                        $mail->setFrom($email_pengirim, $nama_pengirim);
                        $mail->addAddress($email_penerima);
                        $mail->Subject = $subjek;
                        $namaPerusahann = $responsePenyedia->getNamaPerushaan();
                        $posisi = $responseFindMagangAsObj->getPosisi_magang();
                        $datenow = date("Y/m/d");
                        $pesan = <<<HTML
                                <h3>Notifikasi Lamaran Magang dari $nama_pengirim</h3>
                                <p>Halo  , $nama_penerima lamaran untuk posisi $posisi</p>
                                <p>Belum di setujui oleh pihak $namaPerusahann</p>
                                <p>Silahkan mencoba untuk melamar di posisi yang lain ya </p>
                                <br>
                                <br>
                                <p>Salam Manis , Go intern :) </p>
                HTML;
                        $mail->Body =  html_entity_decode($pesan);
                        $mail->isHTML(true);
                        $result =  $mail->send();
                        if ($result) {
                            $response['status'] = 'oke';
                            $response['message'] = 'berhasil mengirim email , berhasil menolak lamaran';
                        } else {
                            $response['status'] = 'failed';
                            $response['message'] = 'gagal mengirim email , gagal menolak lamaran';
                        }
                    } else {
                        $response['status'] = 'failed';
                        $response['message'] = 'gagal menolak lamaran terjadi kesalahan server';
                    }
                } else {
                    $response['status'] = 'failed';
                    $response['message'] = 'gagal menolak , data magang tidak ditemukan';
                }
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'data pencari magang tidak ditemukan';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'data penyedia tidak ditemukan';
        }
        return $response;
    }
}
