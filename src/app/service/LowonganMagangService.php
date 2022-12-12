<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\LowonganMagang;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\repository\LowonganMagangRepository;
use LearnPhpMvc\repository\MagangRepository;
use LearnPhpMvc\repository\PencariMagangRepository;
use LearnPhpMvc\repository\PenyediaMagangRepository;
use LearnPhpMvc\Session\MySession;
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
        $this->repositoryMagang->updateStatusToPenuh();
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

    public function terimaMagang($idPencariMagang, $idMagang)
    {
        $this->repositoryMagang->updateStatusToPenuh();
        $this->repositoryMagang->updateStatusToSebagian();
        $response = array();
        $responseFindPencariMagang = $this->repositoryPencariMagang->findById($idPencariMagang);
        if ($responseFindPencariMagang != null) {
            $responseFindMagang = $this->repositoryMagang->findByIdResult($idMagang);
            if ($responseFindMagang != null) {
                $durasi = $responseFindMagang->getLama_magang();
                $responseCheckAccOrPending =  $this->repositoryLowonganMagang->checkAccOrPending($idPencariMagang, $idMagang);
                if ($responseCheckAccOrPending) {
                    $responseSend = $this->sendEmailTerimaLamaran($idPencariMagang, $idMagang);
                    if ($responseSend['status'] == 'oke') {
                        $response['status'] = 'oke';
                        $response['message'] = 'berhasil menerima lowongan';
                        $responseTerimaLowongan = $this->repositoryLowonganMagang->terimaLamaran($idPencariMagang, $idMagang, $durasi);
                        if ($responseTerimaLowongan) {
                            $response['status'] = 'oke';
                            $response['message'] = 'berhasil menerima lowongan';
                        } else {
                            $response['status'] = 'failed';
                            $response['message'] = 'Terjadi kesalahan';
                        }
                    } else {
                        $response['status'] = 'failed';
                        $response['message'] = 'gagal mengirim email';
                    }
                } else {
                    $response['status'] = 'failed';
                    $response['message'] = 'gagal menerima lamaran , user sudah terdaftar pada magang';
                }
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal menerima lamaran , tidak dapat menemukan data magang';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal menerima lamaran , tidak dapat menemukan data pencari magang';
        }
        return $response;
    }

    public function sendEmailTerimaLamaran($idPencariMagang, $idMagang)
    {
        $this->repositoryMagang->updateStatusToPenuh();
        $this->repositoryMagang->updateStatusToSebagian();
        $response = array();
        $responseFindPencariMagang = $this->repositoryPencariMagang->findById($idPencariMagang);
        if ($responseFindPencariMagang != null) {
            $responseFindMagang = $this->repositoryMagang->findByIdResult($idMagang);
            if ($responseFindMagang != null) {
                $responseFindPenyedia = $this->repositoryPenyedia->findById($responseFindMagang->getPenyedia());
                if ($responseFindPenyedia != null) {
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
                    $namaPerusahann = $responseFindPenyedia->getNamaPerushaan();
                    $posisi = $responseFindMagang->getPosisi_magang();
                    $emailPerusahan = $responseFindPenyedia->getEmail();
                    $datenow = date("Y/m/d");
                    $pesan = <<<HTML
                                    <h3>Notifikasi Lamaran Magang</h3>
                                    <p>Assalamualaikum , Salam sejahtera</p>
                                    <p>$nama_penerima lamaran untuk posisi $posisi</p>
                                    <p>Disetujui Oleh pihak $namaPerusahann</p>
                                    <p>Silahkan Konfirmasi pada email perusahaan yang terkait dibawah ini</p>
                                    <p>$emailPerusahan</p>
                                    <br>
                                    <br>
                                    <p>Salam Manis , Go intern :) </p>
                    HTML;
                    $mail->Body =  html_entity_decode($pesan);
                    $mail->isHTML(true);
                    $responseCheck = $this->checkIsFullAndUpdate($idMagang);
                    if ($responseCheck['status'] == 'oke') {
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
                        $response['message'] = $responseCheck['message'];
                    }
                } else {
                    $response['status'] = 'failed';
                    $response['message'] = 'gagal mengirim email , data penyedia magang tidak ditemukan';
                }
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal mengigim email , data magang tidak ditemukan';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal mengirim email , data user tidak tersedia';
        }
        return $response;
    }
    public function checkIsFullAndUpdate($idMagang)
    {
        $responseFind = $this->repositoryMagang->findByIdResult($idMagang);
        $this->repositoryMagang->updateStatusToSebagian();
        $this->repositoryMagang->updateStatusToPenuh();
        $response = array();
        if ($responseFind != null) {
            if ($responseFind->getJumlah_maksimal() != $responseFind->getJumlah_saatini()) {
                $maksimal = $responseFind->getJumlah_maksimal();
                $saatIni = $responseFind->getJumlah_saatini() + 1;
                $responseUpdate = $this->repositoryMagang->updateMaksimalDanSatIni($maksimal, $saatIni, $idMagang);
                if ($responseUpdate) {
                    $this->repositoryMagang->updateStatusToPenuh();
                    $response['status'] = 'oke';
                    $response['message'] = 'terima lowongan diperbolehkan';
                } else {
                    $response['status'] = 'failed';
                    $response['message'] = 'gagal memperbarui jumlah maksimal magang';
                }
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'Posisi magang sudah penuh';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'data magang tidak ditemukan';
        }
        return $response;
    }

    public function showPemagang($idPenyeia)
    {
        $lowongan = new LowonganMagang();
        $lowongan->setId_penyediaMagang($idPenyeia);
        $response = $this->repositoryLowonganMagang->showPemagang($lowongan);
        if ($response['status'] == "oke") {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        return $response;
    }

    public function keluarkanPemagang($idlowongan, $pemagang): array
    {
        $response = array();
        if (isset($idlowongan)) {
            $responseDelete =  $this->repositoryLowonganMagang->deletePemagang($idlowongan);
            if ($responseDelete) {
                $response['status'] = 'ok';
                $response['message'] = 'berhasil mengeluarkan pemagang';
                $responseFindPemagang =   $this->repositoryPencariMagang->findById($pemagang);
                if ($responseFindPemagang != null) {
                    $email = $responseFindPemagang->getEmail();
                    $nama = $responseFindPemagang->getNama();
                    $mail = new PHPMailer();  // create a new object
                    $email_pengirim = "mohammadtajutzamzami07@gmail.com";
                    $mail->Username = $email_pengirim;
                    $mail->Password = "coskgmkmkonrchpy";
                    $mail->IsSMTP(); // enable SMTP
                    $nama_pengirim =  "Go intern";
                    $subjek = "Notifikasi , Lamaran Magang";
                    $mail->Host = "smtp.gmail.com";
                    $mail->Port =  465;
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'ssl';
                    $mail->setFrom($email_pengirim, $nama_pengirim);
                    $mail->addAddress($email);
                    $mail->Subject = $subjek;
                    $datenow = date("Y/m/d");
                    $pesan = <<<HTML
                                    <h3>Notifikasi  Magang</h3>
                                    <p>Assalamualaikum , Salam sejahtera</p>
                                    <p>$nama anda sudah di keluarkan dari posisi anda magang</p>
                                    <br>
                                    <p>Tetap semangat , salam manis  Go intern :) </p>
                    HTML;
                    $mail->Body =  html_entity_decode($pesan);
                    $mail->isHTML(true);
                    $mail->send();
                }
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal mengeluarkan pemagang , terjadi kesalahan server';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal mengeluarkan pemagang , data id tidak ada';
        }
        return $response;
    }

    public function showPosisiPalingBannyakDiminati($id_penyedia) : array
    {

        $response =  $this->repositoryLowonganMagang->showMagangPalingBanyakDiminati($id_penyedia);
        if($response['status'] == 'oke'){
            http_response_code(200);
        }else{
            http_response_code(400);
        }
        return $response;
    }
}
