<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Domain\Admin;
use PDO;

class AdminRepository
{
    private PDO $connection;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    public function save(Admin $admin): ?Admin
    {
        try {
            $query = "INSERT INTO `admin`(`username`, `password`, `create_at`, `update_at`, `role`, `nama`) VALUES (? , ? , ? , ? , 6 , ?)";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$admin->getUsername(), $admin->getPassword(), $admin->getCreate_at(), $admin->getUpdate_at(), $admin->getNama()]);
            return $admin;
        } catch (\PDOException $th) {
            //throw $th;
            return null;
        }
    }
    public function findByUsername($username): ?Admin
    {
        try {
            $admin = new Admin();
            $query = "select * from admin where username = ?";
            $PDOStatement =  $this->connection->prepare($query);
            $PDOStatement->execute([$username]);
            if ($PDOStatement->rowCount() > 0) {
                $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
                extract($row);
                $admin->setId($id);
                $admin->setUsername($username);
                $admin->setPassword($password);
                $admin->setUpdate_at($update_at);
                $admin->setCreate_at($create_at);
                $admin->setNama($nama);
                return $admin;
            } else {
                return null;
            }
        } catch (\PDOException $th) {
            //throw $th;
            return null;
        }
    }

    public function getUsersRegristation(): array
    {
        $response = array();
        $response['body'] = array();
        $query = "SELECT COUNT(pencari_magang.id) as COUNT , MONTHNAME(pencari_magang.crate_add) as bulan from pencari_magang GROUP BY MONTH(pencari_magang.crate_add)
        ";
        $PDOStatement = $this->connection->query($query);
        if ($PDOStatement->rowCount() > 0) {
            $response['status'] = 'oke';
            $response['message'] = 'terdapat data user terdaftar';
            while ($row = $PDOStatement->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                 $item = [
                    "jumlah" => $COUNT , 
                    "bulan" => $bulan
                 ];
                array_push($response['body'] , $item);
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'tidak ada user terdaftar';
        }
        return $response;
    }

    public function getCompanyRegistration() : array{
        $response = [];
        $query = "SELECT COUNT(penyedia_magang.id) as COUNT , MONTHNAME(penyedia_magang.create_at) as bulan from penyedia_magang GROUP BY MONTH(penyedia_magang.create_at)";
        $PDOStatement =$this->connection->query($query);
        if($PDOStatement->rowCount()> 0){
            $response['status'] = 'oke';
            $response['body'] = [];
            while($row = $PDOStatement->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $item = [
                    "jumlah" => $COUNT , 
                    "bulan" => $bulan
                ];
                array_push($response['body'], $item);
            }
        }else{
            $response['status'] = 'failed';
        }
        return $response;
    }

    // count table data
    public function countPencariMagang() : array{
        $query = "select count(pencari_magang.id) as jumlah from pencari_magang";
        $PDOStatement = $this->connection->query($query);
        $response = [];
        if($PDOStatement->rowCount() > 0){
            $response['status'] = 'oke';
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $response['jumlah'] = $row['jumlah'];
        }else{
            $response['status'] = 'oke';
            $response['jumlah'] = 0;
        }
        return $response;
    }
    public function countPenyediaMagang() : array{
        $query = "select count(penyedia_magang.id) as jumlah from penyedia_magang";
        $PDOStatement = $this->connection->query($query);
        $response = [];
        if($PDOStatement->rowCount() > 0){
            $response['status'] = 'oke';
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $response['jumlah'] = $row['jumlah'];
        }else{
            $response['status'] = 'oke';
            $response['jumlah'] = 0;
        }
        return $response;
    }

    public function countSekolah() : array{
        $query = "select count(sekolah.id) as jumlah from sekolah";
        $PDOStatement = $this->connection->query($query);
        $response = [];
        if($PDOStatement->rowCount() > 0){
            $response['status'] = 'oke';
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $response['jumlah'] = $row['jumlah'];
        }else{
            $response['status'] = 'oke';
            $response['jumlah'] = 0;
        }
        return $response;
    }
    public function countJurusan() : array{
        $query = "select count(jurusan.id) as jumlah from jurusan";
        $PDOStatement = $this->connection->query($query);
        $response = [];
        if($PDOStatement->rowCount() > 0){
            $response['status'] = 'oke';
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $response['jumlah'] = $row['jumlah'];
        }else{
            $response['status'] = 'oke';
            $response['jumlah'] = 0;
        }
        return $response;
    }
}
