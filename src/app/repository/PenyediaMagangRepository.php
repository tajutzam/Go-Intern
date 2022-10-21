<?php

namespace LearnPhpMvc\repository;

use DateTime;
use LearnPhpMvc\Domain\PenyediaMagang;

class PenyediaMagangRepository
{

    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }


    public function findAll() : array{
        $query = "select * from penyedia_magang";
        $PDOStatement = $this->connection->query($query);
        $response = array();
        $response['body']=array();
        if($PDOStatement->rowCount()>0){
            $response['status'] = "oke";
            while($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)){
                extract($row);
                $s = array(
                    "id" => $id ,
                    "nama_perusahaan" => $nama_perusahaan,
                    "alamat_perusahaan" => $alamat_perusahaan ,
                    "email" => $email ,
                    "no_telp"=>$no_telp ,
                    "password"=>$password ,
                    "username"=>$username ,
                    "token"=>$token ,
                    "role"=>$role ,
                    "jenis_usaha"=>$jenis_usaha ,
                    "status"=>$status ,
                    "create_at" =>$create_at ,
                    "update_at" =>$update_at ,
                    "lokasi" => $lokasi ,
                    "foto" => $foto
                );
                array_push($response['body'] , $s);
            }
            return $response;
        }else{
            $response['status'] = "data tidak ada";
            return $response;
        }
    }

    public function save(PenyediaMagang $penyediaMagang) : ? PenyediaMagang{
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $dtNow = gmdate("Y-m-d\TH:i:s" , $timestamp);
        try {
            $query = "INSERT INTO `penyedia_magang`(`nama_perusahaan`, `alamat_perusahaan`, `email`, `no_telp`, `password`, `username`, `token`, `role`, `jenis_usaha`, `status`, `create_at`, `update_at`, `lokasi`, `foto`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([
                $penyediaMagang->getNamaPerushaan(),
                $penyediaMagang->getAlamaPerushaan(),
                $penyediaMagang->getEmail() ,
                $penyediaMagang->getNoTelp() ,
                $penyediaMagang->getPassword() ,
                $penyediaMagang->getUsername() ,
                $penyediaMagang->getToken() ,
                $penyediaMagang->getRole() ,
                $penyediaMagang->getJenisUsaha() ,
                $penyediaMagang->getStatus() ,
                $dtNow ,
                $dtNow ,
                $penyediaMagang->getLokasi() ,
                $penyediaMagang->getFoto()
            ]);
            return $penyediaMagang;
        }catch (\PDOException $exception){
            var_dump($exception);
            return null;
        }
    }

    public function findById($id) :  ? PenyediaMagang{
        $penyediaMagang = new PenyediaMagang();
        $query = "select * from penyedia_magang where id = ?";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$id]);
        if ($PDOStatement->rowCount() > 0){
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)){
                $penyediaMagang->setId($row['id']);
                $penyediaMagang->setNamaPerushaan($row['nama_perusahaan']);
                $penyediaMagang->setAlamaPerushaan($row['alamat_perusahaan']);
                $penyediaMagang->setEmail($row['email']);
                $penyediaMagang->setNoTelp($row['no_telp']);
                $penyediaMagang->setPassword($row['password']);
                $penyediaMagang->setUsername($row['username']);
                $penyediaMagang->setToken($row['token']);
                $penyediaMagang->setRole($row['role']);
                $penyediaMagang->setJenisUsaha($row['jenis_usaha']);
                $penyediaMagang->setStatus($row['status']);
                $penyediaMagang->setCreateAt($row['create_at']);
                $penyediaMagang->setUpdateAt($row['update_at']);

            }
        }else{
            echo "data tidak ada";
            return null;
        }
    }
}