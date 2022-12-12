<?php

namespace LearnPhpMvc\repository;

use DateTime;
use LearnPhpMvc\Domain\LowonganMagang;
use PDO;
use PDOException;

class LowonganMagangRepository
{

    private PDO $connection;






    /**
     * @param PDO $connection 
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function addLowonganMagang(LowonganMagang $lowonganMagang): ?LowonganMagang
    {

        try {
            $query = "insert into lowongan_magang (id_magang , pencariMagang , start_on , finish_on , status , penyediaMagang) values (? , ? , ? , ? , ? , ?)";
            $PDOstatement =  $this->connection->prepare($query);
            $PDOstatement->execute([$lowonganMagang->getId_magang(), $lowonganMagang->getId_pencariMagang(), null, null, 'pending', $lowonganMagang->getId_penyediaMagang()]);
            $lowonganMagang->setId($this->connection->lastInsertId());
            return $lowonganMagang;
        } catch (\PDOException $th) {
            var_dump($th);
            return null;
        }
    }

    public function showLamaranByPenyedia($id_penyedia): array
    {
        $query = "SELECT  DISTINCT pencari_magang.id as id_pencari ,  pencari_magang.tentang_saya , pencari_magang.foto , magang.id as id_magang ,  pencari_magang.id as id_pencari , magang.posisi_magang , pencari_magang.nama , pencari_magang.cv , pencari_magang.surat_lamaran , penghargaan.file as file_penghargaan,  pencari_magang.email , pencari_magang.agama , pencari_magang.jenis_kelamin , lowongan_magang.status  , sekolah.nama_sekolah , jurusan.jurusan from pencari_magang join lowongan_magang on pencari_magang.id = lowongan_magang.pencariMagang join magang on magang.id = lowongan_magang.id_magang join penghargaan on pencari_magang.id_penghargaan = penghargaan.id_penghargaan join sekolah on pencari_magang.id_sekolah = sekolah.id join jurusan on pencari_magang.jurusan = jurusan.id where lowongan_magang.penyediaMagang = ? and lowongan_magang.status != 'acc'";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$id_penyedia]);
        $response = array();
        $response['body'] = array();
        if ($PDOStatement->rowCount() > 0) {
            $response['status'] = 'oke';
            $response['message'] = 'ada data pelamar';
            while ($row = $PDOStatement->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    "posisi_magang" => $posisi_magang,
                    "nama_magang" => $nama,
                    "cv" => $cv,
                    "surat_lamaran" => $surat_lamaran,
                    "file_penghargaan" => $file_penghargaan,
                    "email" => $email,
                    "agama" => $agama,
                    "jenis_kelamin" => $jenis_kelamin,
                    "status" => $status,
                    "foto" => $foto,
                    "nama_sekolah" => $nama_sekolah,
                    "jurusan" => $jurusan,
                    "id_pencari" => $id_pencari,
                    "id_magang" => $id_magang,
                    "tentang_saya" => $tentang_saya
                );
                array_push($response['body'], $item);
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'data lowongan tidak ada';
        }
        return $response;
    }
    public function updateToPending($id): bool
    {
        try {
            $query = "update lowongan_magang set status = 'pending' where id = ? ";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$id]);
            return true;
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        }
    }

    public function checkIfExist($idPencariMagang, $idMagang)
    {
        $query = "select COUNT(lowongan_magang.id_magang) as jumlah from lowongan_magang where lowongan_magang.pencariMagang = ? and lowongan_magang.id_magang= ?";
        $PDOstatement = $this->connection->prepare($query);
        $PDOstatement->execute([$idPencariMagang, $idMagang]);
        $row = $PDOstatement->fetch(PDO::FETCH_ASSOC);
        if ($row['jumlah'] != 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function tolakLamaran(LowonganMagang $lowonganMagang): bool
    {
        try {
            $query = "delete from lowongan_magang where pencariMagang = ? and id_magang = ?";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$lowonganMagang->getId_pencariMagang(), $lowonganMagang->getId_magang()]);
            return true;
        } catch (PDOException $th) {
            //throw $th;
            return false;
        }
    }

    public function deletePemagang($id): bool
    {
        try {
            $query = "delete from lowongan_magang where id = ?";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$id]);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }

    public function terimaLamaran($idPencariMagang, $idMagang, $durasi)
    {
        // todo tolak lamaran
        // tanggal lahir , tahun-bulan-tanggal
        $startOn = date("Y-m-d");
        $finishOn = new DateTime('now');
        $finishOn->modify("+$durasi month"); // or you can use '-90 day' for deduct
        $finishOn = $finishOn->format('Y-m-d');
        try {
            $query = "update lowongan_magang set status = 'acc' , start_on = ?  , finish_on = ? where pencariMagang = ? and id_magang = ? and status != 'acc'";
            $PDOstatement = $this->connection->prepare($query);
            $PDOstatement->execute([$startOn, $finishOn, $idPencariMagang, $idMagang]);
            return true;
        } catch (PDOException $th) {
            //throw $th;
            var_dump($th);
            return false;
        }
    }

    public function checkAccOrPending($idPencariMagang, $idMagang)
    {
        $query = "select  * from lowongan_magang where pencariMagang = ? and id_magang = ? and status !='acc'";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$idPencariMagang, $idMagang]);
        if ($PDOStatement->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function showPemagang(LowonganMagang $lowonganMagang)
    {
        $query = "select  pencari_magang.id as pemagang ,  lowongan_magang.id ,   magang.posisi_magang , pencari_magang.nama , pencari_magang.jenis_kelamin , sekolah.nama_sekolah , jurusan.jurusan , lowongan_magang.start_on , lowongan_magang.finish_on , pencari_magang.email , pencari_magang.agama , pencari_magang.no_telp , pencari_magang.tanggal_lahir , pencari_magang.cv , pencari_magang.foto , pencari_magang.tentang_saya ,  penghargaan.file as penghargaan from lowongan_magang join magang on lowongan_magang.id_magang = magang.id join pencari_magang on lowongan_magang.pencariMagang = pencari_magang.id join sekolah on sekolah.id = pencari_magang.id_sekolah  join jurusan on pencari_magang.jurusan  = jurusan.id  join penghargaan on pencari_magang.id_penghargaan = penghargaan.id_penghargaan WHERE lowongan_magang.status = 'acc' and penyediaMagang = ?";
        $response = array();
        $PDOStatement = $this->connection->prepare($query);
        $dateNowFormated = date("Y-m-d");
        $dateNow = new DateTime($dateNowFormated);
        $PDOStatement->execute([$lowonganMagang->getId_penyediaMagang()]);
        if ($PDOStatement->rowCount() > 0) {
            $response['status'] = 'oke';
            $response['message'] = 'data pemagang di temukan';
            $response['body'] = array();
            while ($row = $PDOStatement->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $dateFinish = new DateTime($finish_on);
                $interfal = $dateNow->diff($dateFinish);
                $item = array(
                    "posisi_magang" => $posisi_magang,
                    "nama_pemagang" => $nama,
                    "jenis_kelamin" => $jenis_kelamin,
                    "nama_sekolah" => $nama_sekolah,
                    "jurusan" => $jurusan,
                    "start_on" => $start_on,
                    "finish_on" => $finish_on,
                    "selesai dalam" => "" . $interfal->y . " tahun," . $interfal->m . " bulan, " . $interfal->d . " hari",
                    "email" => $email,
                    "cv" => $cv,
                    "agama" => $agama,
                    "no_telp" => $no_telp,
                    "tanggal_lahir" => $tanggal_lahir,
                    "foto" => $foto,
                    "tentang_saya" => $tentang_saya,
                    "penghargaan" => $penghargaan,
                    "id" => $id,
                    "pemagang" => $pemagang
                );
                array_push($response['body'], $item);
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'data pemagang tidak ditemukan';
        }
        return $response;
    }

    public function showMagangPalingBanyakDiminati($id_penyedia): array
    {
        $query = "select magang.posisi_magang , COUNT(magang.posisi_magang) as jumlah FROM lowongan_magang JOIN magang on magang.id = lowongan_magang.id_magang WHERE lowongan_magang.penyediaMagang = ? GROUP BY magang.posisi_magang ORDER BY jumlah DESC";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$id_penyedia]);
        $response = array();
        if ($PDOStatement->rowCount() > 0) {
            $response['body'] = array();
            $response['status'] = 'oke';
            $response['message'] = 'ada data';
            while ($row = $PDOStatement->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    "posisi" => $posisi_magang,
                    "jumlah" => $jumlah
                );
                array_push($response['body'], $item);
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'data magang tidak ditemukan';
        }
        return $response;
    }
}
