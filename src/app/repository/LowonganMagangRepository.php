<?php

namespace LearnPhpMvc\repository;

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
        $query = "SELECT  DISTINCT pencari_magang.tentang_saya , pencari_magang.foto , magang.id as id_magang ,  pencari_magang.id as id_pencari , magang.posisi_magang , pencari_magang.nama , pencari_magang.cv , pencari_magang.surat_lamaran , penghargaan.file as file_penghargaan,  pencari_magang.email , pencari_magang.agama , pencari_magang.jenis_kelamin , lowongan_magang.status  , sekolah.nama_sekolah , jurusan.jurusan from pencari_magang join lowongan_magang on pencari_magang.id = lowongan_magang.pencariMagang join magang on magang.id = lowongan_magang.id_magang join penghargaan on pencari_magang.id_penghargaan = penghargaan.id_penghargaan join sekolah on pencari_magang.id_sekolah = sekolah.id join jurusan on pencari_magang.jurusan = jurusan.id where lowongan_magang.penyediaMagang = ?  and lowongan_magang.status != 'acc'";
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
                    "id_pencari" => $id_pencari , 
                    "id_magang" => $id_magang ,
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

    public function tolakLamaran(LowonganMagang $lowonganMagang) : bool
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
}
