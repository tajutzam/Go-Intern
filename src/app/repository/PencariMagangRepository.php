<?php

namespace LearnPhpMvc\repository;

use DateTime;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\Sekolah;
use LearnPhpMvc\dto\AktivasiAkunResponse;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\Domain\Penghargaan;
use PDO;
use PDOException;
use PDOStatement;


class PencariMagangRepository
{
    public PDO $connection;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    public function findAll(): array
    {
        $query = "select * from pencari_magang";
        $PDOStatement = $this->connection->query($query);
        $response = array();
        $response['length'] = 0;
        $response['datum'] = array();
        //        $response['data'] = array();
        if ($PDOStatement->rowCount() > 0) {
            $response['status'] = "oke";
            while ($result = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($result);
                $item = array(
                    "id" => $id,
                    "username" => $username,
                    "password" => $password,
                    "email" => $email,
                    "id_sekolah" => $id_sekolah,
                    "no_telp" => $no_telp,
                    "agama" => $agama,
                    "tanggal_lahir" => $tanggal_lahir,
                    "token" => $token,
                    "cv" => $cv,
                    "resume" => $resume,
                    "status" => $status,
                    "status_magang" => $status_magang,
                    "role" => $role,
                    "crate_add" => $crate_add,
                    "update_add" => $update_add,
                    "expired_token" => $expired_token,
                    "tentang-saya" => $tentang_saya,
                    "jenis_kelamin" => $jenis_kelamin
                );
                array_push($response['datum'], $item);
            }
            $response['length'] = $PDOStatement->rowCount();
        } else {
            $response['status'] = "data tidak ditemukan";
        }
        return $response;
    }
    public function deleteAll()
    {
        $this->connection->exec("delete from pencari_magang");
    }
    public function save(PencariMagang $pencariMagang, Sekolah $sekolah): ?PencariMagang
    {
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $dtNow = gmdate("Y-m-d\TH:i:s", $timestamp);
        try {
            $this->connection->beginTransaction();
            $query = "INSERT INTO `pencari_magang`( `username`, `password`, `email`, `no_telp`, `agama`, `tanggal_lahir`, `token`, `cv`, `resume`, `status`, `status_magang`, `role`, `crate_add`, `update_add` , `foto` , `nama` , `jenis_kelamin`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,? ,? , ?)";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute(
                [
                    $pencariMagang->getUsername(),
                    $pencariMagang->getPassword(),
                    $pencariMagang->getEmail(),

                    $pencariMagang->getNo_telp(),
                    $pencariMagang->getAgama(),
                    $pencariMagang->getTanggalLahir(),
                    $pencariMagang->getToken(),
                    $pencariMagang->getCv(),
                    $pencariMagang->getResume(),
                    $pencariMagang->getStatus(),
                    $pencariMagang->isStatusMagang(),
                    $pencariMagang->getRole(),
                    $dtNow,
                    $dtNow,
                    $pencariMagang->getFoto(),
                    $pencariMagang->getNama(),
                    $pencariMagang->getJenis_kelamin()
                ]
            );
            $this->connection->commit();

            return $pencariMagang;
        } catch (\PDOException $exception) {

            return null;
        }
    }

    public function findById($id): ?PencariMagang
    {
        $sekolah = new Sekolah();
        $pencariMagang = new PencariMagang();
        $query = "select * from pencari_magang where id = ?";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$id]);

        if ($PDOStatement->rowCount() > 0) {
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                $pencariMagang->setId($row['id']);
                $pencariMagang->setUsername($row['username']);
                $pencariMagang->setPassword($row['password']);
                $pencariMagang->setEmail($row['email']);
                $pencariMagang->setIdSekolah($row['id_sekolah'] == null ? null : $row['id_sekolah']);
                $pencariMagang->setNo_telp($row['no_telp'] == null ? 0 : $row['no_telp']);
                $pencariMagang->setAgama($row['agama'] == null ? "" : $row['agama']);
                $pencariMagang->setTanggalLahir($row['tanggal_lahir']);
                $pencariMagang->setToken($row['token']);
                $pencariMagang->setCv($row['cv'] == null ? "" : $row['cv']);
                $pencariMagang->setResume($row['resume'] == null ? "" : $row['resume']);
                $pencariMagang->setStatus($row['status']);
                $pencariMagang->setStatusMagang($row['status_magang']);
                $pencariMagang->setRole($row['role']);
                $pencariMagang->setCreate_at($row['crate_add']);
                $pencariMagang->setUpdate_at($row['update_add']);
                $pencariMagang->setNama($row['nama']);
                $pencariMagang->setFoto($row['foto']  == null ? "" : $row['foto']);
                $pencariMagang->setNama($row['nama']);
                $pencariMagang->setJenis_kelamin($row['jenis_kelamin']);
                $pencariMagang->setPenghargaan($row['id_penghargaan'] == null ? 0 : $row['id_penghargaan']);
                $pencariMagang->setSuratLamaran($row['surat_lamaran'] == null ? "" : $row['surat_lamaran']);
                $pencariMagang->setJurusan($row['jurusan'] == null ? 0 : $row['jurusan']);
            } 
            return $pencariMagang;
        } else {
            return null;
        }
    }
    public function update(PencariMagang $pencariMagang): ?PencariMagang
    {
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $dtNow = gmdate("Y-m-d\TH:i:s", $timestamp);
        $now_stamp = date("Y-m-d H:i:s");
        $magang = $this->findById($pencariMagang->getId());
        $this->connection->beginTransaction();
        if ($magang == null) {
            return null;
        } else {
            try {
                $query = "UPDATE `pencari_magang` SET `username`=?,`password`=?,`email`=?,`id_sekolah`=?,`no_telp`=?,`agama`=?,`tanggal_lahir`=?,`token`=?,`cv`=?,`resume`=?,`status`=?,`status_magang`=?,`role`=?,`update_add`=? , `foto` = ? WHERE id = ?";
                $PDOStatement = $this->connection->prepare($query);
                $PDOStatement->execute(
                    [
                        $pencariMagang->getUsername(),
                        $pencariMagang->getPassword(),
                        $pencariMagang->getEmail(),
                        $pencariMagang->getIdSekolah(),
                        $pencariMagang->getNo_telp(),
                        $pencariMagang->getAgama(),
                        $pencariMagang->getTanggalLahir(),
                        $pencariMagang->getToken(),
                        $pencariMagang->getCv(),
                        $pencariMagang->getResume(),
                        $pencariMagang->getStatus(),
                        $pencariMagang->isStatusMagang(),
                        $pencariMagang->getRole(),
                        $now_stamp,
                        $pencariMagang->getFoto(),
                        $pencariMagang->getId()
                    ]
                );
                return $pencariMagang;
                $this->connection->commit();
            } catch (\PDOException $PDOException) {
                $this->connection->rollBack();
                return null;
            }
        }
    }

    public function deleteById($id): bool
    {
        $this->connection->beginTransaction();
        $pencariMagang = $this->findById($id);
        if ($pencariMagang == null) {
            return false;
        } else {
            try {

                $query = "delete from pencari_magang where id = ?";
                $PDOStatement = $this->connection->prepare($query);
                $PDOStatement->execute([$id]);
                $this->connection->commit();
                return true;
            } catch (\PDOException $PDOException) {
                $this->connection->rollBack();
                return false;
            }
        }
    }

    public function findByUsername($username): array
    {
        $query = <<<SQL
    select  * from pencari_magang where username = ?
SQL;
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$username]);
        //        $response['data'] = array();
        if ($PDOStatement->rowCount() > 0) {
            http_response_code(200);
            $response['status'] = "oke";
            $response['body'] = array();
            while ($result = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($result);
                $item = array(
                    "id" => $id,
                    "username" => $username,
                    "password" => $password,
                    "email" => $email,
                    "id_sekolah" => $id_sekolah,
                    "no_telp" => $no_telp,
                    "agama" => $agama,
                    "tanggal_lahir" => $tanggal_lahir,
                    "token" => $token,
                    "cv" => $cv,
                    "resume" => $resume,
                    "status" => $status,
                    "status_magang" => $status_magang,
                    "role" => $role,
                    "crate_add" => $crate_add,
                    "update_add" => $update_add,
                    "expired_token" => $expired_token,
                    "tentang-saya" => $tentang_saya,
                    "nama" => $nama,
                    "foto" => $foto,
                    "jenis_kelamin" => $jenis_kelamin,
                    "id_penghargaan" => $id_penghargaan == null ? 0 : $id_penghargaan,
                    "deskripsi" => $deskripsi_sekolah,
                    "surat_lamaran" => $surat_lamaran
                );
                array_push($response['body'], $item);
            }
            $response['length'] = count($response['body']);
            http_response_code(200);
        } else {
            http_response_code(404);
            $response['status'] = "data tidak ditemukan";
        }
        return $response;
    }
    public function findByToken($token): array
    {
        $query = <<<SQL
    select  * from pencari_magang where token = ?
SQL;
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$token]);
        $response = array();
        //        $response['data'] = array();
        if ($PDOStatement->rowCount() > 0) {
            http_response_code(200);
            $response['status'] = "oke";
            $response['body'] = array();
            while ($result = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($result);
                $item = array(
                    "id" => $id,
                    "username" => $username,
                    "password" => $password,
                    "email" => $email,
                    "id_sekolah" => $id_sekolah,
                    "no_telp" => $no_telp,
                    "agama" => $agama,
                    "tanggal_lahir" => $tanggal_lahir,
                    "token" => $token,
                    "cv" => $cv,
                    "resume" => $resume,
                    "status" => $status,
                    "status_magang" => $status_magang,
                    "role" => $role,
                    "crate_add" => $crate_add,
                    "update_add" => $update_add,
                    "expired_token" => $expired_token,
                    "jenis_kelamin" => $jenis_kelamin
                );
                array_push($response['body'], $item);
            }
            $response['length'] = count($response['body']);
            http_response_code(200);
        } else {
            http_response_code(404);
            $response['status'] = "data tidak ditemukan";
        }
        return $response;
    }

    public function savePencariMagnag(PencariMagang $pencariMagang, Sekolah $sekolah): ?PencariMagang
    {
        try {
            $query = <<< SQL
    insert into pencari_magang (`username` , `email` , `password` , `nama` , `token` , `role` , `tanggal_lahir` , `jenis_kelamin`) values  
    (? , ? , ? , ? , ? ,?  , ?  , ?)
SQL;
            $sekolah = new Sekolah();

            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([
                $pencariMagang->getUsername(),
                $pencariMagang->getEmail(),
                $pencariMagang->getPassword(),
                $pencariMagang->getNama(),
                $pencariMagang->getToken(),
                $pencariMagang->getRole(),
                $pencariMagang->getTanggalLahir(),
                $pencariMagang->getJenis_kelamin()
            ]);
            return $pencariMagang;
        } catch (\PDOException $exception) {
            var_dump($exception);
            return null;
        }
    }
    public function updateExpaired(AktivasiAkunResponse $aktivasiAkunResponse, PencariMagang $pencariMagang): array
    {
        $query = <<<SQL
        update pencari_magang set expired_token=? where username=?
SQL;
        try {
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$aktivasiAkunResponse->getExpired(), $pencariMagang->getUsername()]);
            $response = array();
            $response['status'] = "oke";
            return $response;
        } catch (\Exception $exception) {
            $response['status'] = $exception->getMessage();
            return $response;
        }
    }
    public function updatStatus($username)
    {
        $query = <<<SQL
        update pencari_magang set status = "aktif" where username = ?
SQL;
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$username]);
    }

    public function findByUsernameLike(PencariMagang $pencariMagang): array
    {
        $response = array();
        $query = "SELECT * FROM pencari_magang WHERE username LIKE CONCAT('%',?,'%') ";
        $PDOStatement = $this->connection->prepare($query);
        $parameter = $pencariMagang->getUsername();
        $PDOStatement->execute([$parameter]);
        if ($PDOStatement->rowCount() > 0) {
            $response['status'] = "ok";
            $response['body'] = array();
            while ($result = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($result);
                $item = array(
                    "id" => $id,
                    "username" => $username,
                    "password" => $password,
                    "email" => $email,
                    "id_sekolah" => $id_sekolah,
                    "no_telp" => $no_telp,
                    "agama" => $agama,
                    "tanggal_lahir" => $tanggal_lahir,
                    "token" => $token,
                    "cv" => $cv,
                    "resume" => $resume,
                    "status" => $status,
                    "status_magang" => $status_magang,
                    "role" => $role,
                    "crate_add" => $crate_add,
                    "update_add" => $update_add,
                    "expired_token" => $expired_token
                );
                array_push($response['body'], $item);
            }
        } else {
            $response['status'] = "data tidak ditemukan";
        }
        return $response;
    }

    public function findByStatusAktiv(): array
    {
        $query = "select * from pencari_magang where status = 'aktif'";
        $PDOStatement = $this->connection->query($query);
        $response = array();
        $response['data'] = array();
        $response['length'] = 0;
        if ($PDOStatement->rowCount() > 0) {
            $response['status'] = "oke";
            $response['length'] = $PDOStatement->rowCount();
            while ($result = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($result);
                $item = array(
                    "id" => $id,
                    "username" => $username,
                    "password" => $password,
                    "email" => $email,
                    "id_sekolah" => $id_sekolah,
                    "no_telp" => $no_telp,
                    "agama" => $agama,
                    "tanggal_lahir" => $tanggal_lahir,
                    "token" => $token,
                    "cv" => $cv,
                    "resume" => $resume,
                    "status" => $status,
                    "status_magang" => $status_magang,
                    "role" => $role,
                    "crate_add" => $crate_add,
                    "update_add" => $update_add,
                    "expired_token" => $expired_token,
                    "jenis_kelamin" => $jenis_kelamin
                );
                array_push($response['data'], $item);
            }
        } else {
            $response['status'] = "data tidak ditemukan";
        }
        return $response;
    }

    public function updateTentangSaya(PencariMagang $pencariMagang): bool
    {
        try {

            $query  = "update pencari_magang set tentang_saya = ?  where id = ? ";
            $response = $this->connection->prepare($query);
            $response->execute([$pencariMagang->getTentang_saya(), $pencariMagang->getId()]);
            return true;
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        }
    }

    public function updateDeskripsiSekolah(PencariMagang $pencariMagang): ?PencariMagang
    {
        try {
            $query = 'update pencari_magang set deskripsi_sekolah  = ? where id = ?';
            $PDOstatement =  $this->connection->prepare($query);
            $PDOstatement->execute([$pencariMagang->getDeskripsi_sekolah(), $pencariMagang->getId()]);
            return $pencariMagang;
        } catch (\PDOException $th) {
            //throw $th
            var_dump($th);
            return null;
        }
    }

    public function findBySekolah(PencariMagang $pencariMagang): array
    {
        $query = "select pencari_magang.nama , sekolah.nama_sekolah , jurusan.jurusan , sekolah.id from pencari_magang join sekolah on pencari_magang.id_sekolah = sekolah.id  join jurusan on sekolah.jurusan = jurusan.id where pencari_magang.id = ?";
        $PDOstatement =  $this->connection->prepare($query);
        $PDOstatement->execute([$pencariMagang->getId()]);
        $response = array();
        $response['body'] = array();
        if ($PDOstatement->rowCount() > 0) {
            $response['status'] = 'oke';
            $response['message'] = 'Berhasil menemukan sekolah ';
            while ($row = $PDOstatement->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'nama' => $row['nama'],
                    'id' => $pencariMagang->getId(),
                    'sekolah' => $row['nama_sekolah'],
                    'id_sekolah' => $row['id'],
                    'jurusan' => $row['jurusan']
                );
                array_push($response['body'], $item);
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal menemukan Sekolah tambahkan data sekolah terlebih dahulu';
        }
        return $response;
    }

    public function saveImage(PencariMagang $pencariMagang): ?PencariMagang
    {
        try {
            $query =   "update pencari_magang set foto = ? where username = ?";
            $PDOstatement =  $this->connection->prepare($query);
            $PDOstatement->execute([$pencariMagang->getFoto(), $pencariMagang->getUsername()]);
            return $pencariMagang;
        } catch (\PDOException $th) {
            //throw $th;
            var_dump($th);
            return null;
        }
    }

    public function addSekolah(PencariMagang $pencariMagang): bool
    {
        try {
            $query = "update pencari_magang set id_sekolah = ? , jurusan = ? where id = ?";
            $PDOstatement = $this->connection->prepare($query);
            $PDOstatement->execute([$pencariMagang->getIdSekolah(), $pencariMagang->getJurusan(), $pencariMagang->getId()]);
            return true;
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        }
    }

    public function showDataSekolah($id): array
    {
        $response = array();
        $query = "SELECT jurusan.jurusan , sekolah.nama_sekolah  , pencari_magang.nama  ,  pencari_magang.deskripsi_sekolah from jurusan , sekolah , pencari_magang INNER join jurusan_sekolah where pencari_magang.jurusan = jurusan.id and sekolah.id = pencari_magang.id_sekolah and pencari_magang.id = ? LIMIT 1";
        $PDOStatement = $this->connection->prepare($query);
        $response['body'] = array();
        $PDOStatement->execute([$id]);
        if ($PDOStatement->rowCount() > 0) {
            http_response_code(200);
            $response['status'] = 'oke';
            $response['message'] = 'user memiliki data sekolah';
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $item = array(
                "jurusan" => $row['jurusan'],
                "nama_sekolah" => $row['nama_sekolah'],
                "nama_pencari_magang" => $row['nama'],
                "deskripsi" => $row['deskripsi_sekolah']
            );
            array_push($response['body'], $item);
        } else {
            http_response_code(400);
            $response['status'] = 'failed';
            $response['message'] = 'user belum memiliki data sekolah';
        }
        return  $response;
    }

    public function addPenghargaan(PencariMagang $pencariMagang, Penghargaan $penghargaan): bool
    {
        try {
            $query = "update pencari_magang set id_penghargaan = ? where username = ? ";
            $PDOStatement =  $this->connection->prepare($query);
            $PDOStatement->execute([$penghargaan->getId_penghargaan(), $pencariMagang->getUsername()]);
            return true;
        } catch (PDOException $th) {
            var_dump($th);
            return false;
        }
    }
    public function updateDataPersonal(PencariMagang $pencariMagang): ?PencariMagang
    {
        try {
            $query = "update pencari_magang set nama = ?  , email = ? , tanggal_lahir = ?  , agama = ? , jenis_kelamin = ?  where id = ? ";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$pencariMagang->getNama(), $pencariMagang->getEmail(), $pencariMagang->getTanggalLahir(), $pencariMagang->getAgama(), $pencariMagang->getJenis_kelamin(), $pencariMagang->getId()]);
            return $pencariMagang;
        } catch (PDOException $th) {
            var_dump($th);
            return null;
        }
    }
    public function updateKeamanan(PencariMagang $pencariMagang): ?PencariMagang
    {
        try {
            //code...
            $quer  = "update pencari_magang set username = ?   , password  = ? where id = ? ";
            $PDOStatement = $this->connection->prepare($quer);
            $PDOStatement->execute([$pencariMagang->getUsername(), $pencariMagang->getPassword(), $pencariMagang->getId()]);
            return $pencariMagang;
        } catch (PDOException $th) {
            //throw $th;
            var_dump($th);
            return null;
        }
    }

    public function updateCv(PencariMagang $pencariMagang): ?PencariMagang
    {
        try {
            $query  = "update pencari_magang set cv = ? where username = ?";
            $PDOstatement = $this->connection->prepare($query);
            $PDOstatement->execute([$pencariMagang->getCv(), $pencariMagang->getUsername()]);
            return $pencariMagang;
        } catch (PDOException $th) {
            //throw $th;
            return null;
        }
    }
    public function findCvByUsername(PencariMagang $pencariMagang): ?PencariMagang
    {
        $this->connection->beginTransaction();
        $query = "select cv from pencari_magang where username = ?";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$pencariMagang->getUsername()]);
        if ($PDOStatement->rowCount() > 0) {
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $pencariMagang->setCv($row['cv'] == null ? "belum ada cv" : $row['cv']);
            $this->connection->commit();
            return $pencariMagang;
        } else {
            $this->connection->rollBack();
            return null;
        }
    }


    public function updateSuratLamaran($surat_lamatan, $id): bool
    {
        try {
            $query = "update pencari_magang set surat_lamaran = ? where id = ?";
            $PDOstatement = $this->connection->prepare($query);
            $PDOstatement->execute([$surat_lamatan, $id]);
            return true;
        } catch (PDOException $th) {
            //throw $th;
            return false;
        }
    }

    public function updateNoHp($noHp, $id)
    {
        try {
            $query = "update pencari_magang set no_telp = ? where id =?";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$noHp, $id]);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
}
