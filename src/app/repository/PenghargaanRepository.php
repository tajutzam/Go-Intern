<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\Penghargaan;
use PDO;

class PenghargaanRepository
{


    private PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function addPenghargaan(Penghargaan $penghargaan): ?Penghargaan
    {
        try {
            $query = "insert into penghargaan (`judul` , `file`) values (? , ?)";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$penghargaan->getJudul(), $penghargaan->getFile()]);
            $penghargaan->setId_penghargaan($this->connection->lastInsertId());
            return $penghargaan;
        } catch (\PDOException $th) {
            //throw $th;
            var_dump($th);
            return null;
        }
    }

    public function findById(Penghargaan $penghargaan): ?Penghargaan{
        try {
        $query = "select * from penghargaan where id_penghargaan = ? ";
        $PDOStatemtn = $this->connection->prepare($query);
        $PDOStatemtn->execute([$penghargaan->getId_penghargaan()]);
        if($PDOStatemtn->rowCount() > 0){
            $row = $PDOStatemtn->fetch(PDO::FETCH_ASSOC);
            $penghargaan->setId_penghargaan($row['id_penghargaan']);
            $penghargaan->setJudul($row['judul']);
            $penghargaan->setFile($row['file']);
            return $penghargaan;
        }else{
            return null;
        }
        } catch (\PDOException $th) {
            return null;
        }
    }

    public function updatePenghargaan(Penghargaan $penghargaan) :bool{
      try {
        $query = "update penghargaan set judul = ? , file = ? where id_penghargaan = ? ";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$penghargaan->getJudul() , $penghargaan->getFile() , $penghargaan->getId_penghargaan()]);
        return true;
      } catch (\PDOException $th) {
        //throw $th;
        var_dump($th);
        return false;
      }
    } 

    public function findByPencariMagang(PencariMagang $pencariMagang) : array{
        $query  = "select penghargaan.id_penghargaan , penghargaan.judul , penghargaan.file , pencari_magang.nama from pencari_magang join penghargaan on  penghargaan.id_penghargaan = pencari_magang.id_penghargaan and  pencari_magang.id = ?";
        $response = array();
        $response['body'] = array();
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$pencariMagang->getId()]);
        if($PDOStatement->rowCount() > 0){
            http_response_code(200);
            $response['status'] = 'oke';
            $response['message'] = 'user memiliki penghargaan';
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $item = array(
                "id_penghargaan" => $row['id_penghargaan'] , 
                "judul" => $row['judul'] , 
                "filename" => $row['file'] , 
                "nama" => $row['nama']
            );
            array_push($response['body'] , $item);
        }else{
            http_response_code(404);
            $response['status'] = 'failed';
            $response['message'] ='user belum memiliki penghargaan';
        }
        return $response;
    }
}
