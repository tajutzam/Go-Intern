<?php

namespace LearnPhpMvc\repository;

use DateTime;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\Sekolah;
use LearnPhpMvc\dto\AktivasiAkunResponse;
use LearnPhpMvc\dto\LoginRequest;
use PDO;
use PDOStatement;

class PencariMagangRepository
{
    public \PDO $connection;
    public function __construct(\PDO $connection)
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
                    "expired_token" => $expired_token
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
            $query = "INSERT INTO `pencari_magang`( `username`, `password`, `email`, `no_telp`, `agama`, `tanggal_lahir`, `token`, `cv`, `resume`, `status`, `status_magang`, `role`, `crate_add`, `update_add` , `foto` , `nama`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,? , ?)";
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
                    $pencariMagang->getNama()
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
                $pencariMagang->setIdSekolah($row['id_sekolah']);
                $pencariMagang->setNo_telp($row['no_telp']);
                $pencariMagang->setAgama($row['agama']);
                $pencariMagang->setTanggalLahir($row['tanggal_lahir']);
                $pencariMagang->setToken($row['token']);
                $pencariMagang->setCv($row['cv']);
                $pencariMagang->setResume($row['resume']);
                $pencariMagang->setStatus($row['status']);
                $pencariMagang->setStatusMagang($row['status_magang']);
                $pencariMagang->setRole($row['role']);
                $pencariMagang->setCreate_at($row['crate_add']);
                $pencariMagang->setUpdate_at($row['update_add']);
                $pencariMagang->setNama($row['nama']);
                $pencariMagang->setFoto($row['foto']);
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
                        $now_stamp ,
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
                    "expired_token" => $expired_token
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
                    "expired_token" => $expired_token
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
    insert into pencari_magang (`username` , `email` , `password` , `nama` , `token` , `role` , `tanggal_lahir`) values  
    (? , ? , ? , ? , ? ,?  , ? )
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
            ]);
            return $pencariMagang;
        } catch (\PDOException $exception) {
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

    public function findByStatusAktiv():array{
        $query = "select * from pencari_magang where status = 'aktif'";
        $PDOStatement = $this->connection->query($query);
        $response = array();
        $response['data'] = array();
        $response['length']=0;
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
                    "expired_token" => $expired_token
                );
                array_push($response['data'], $item);
            }
        } else {
            $response['status'] = "data tidak ditemukan";
        }
        return $response;
    }
}
