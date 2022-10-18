<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Domain\Sekolah;

class SekolahRepository
{

    private \PDO $connection;

    /**
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll() : array{
        $query = "select id , nama_sekolah , jurusan from sekolah";
        $PDOStatement = $this->connection->query($query);
        $response = array();
        $response['data']=array();
        if ($PDOStatement->rowCount()>0){
            http_response_code(200);
            $response['status'] = "ok";
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)){
                extract($row);
                $s = array(
                    "id" => $id ,
                    "nama_sekolah" =>$nama_sekolah,
                    "jurusan" =>$jurusan
                );
                array_push($response['data'], $s);
            }
        }else{
            http_response_code(404);
            $response['status'] = "data tidak ditemukan";
        }
        return $response;
    }

    public function findById($id) : ?Sekolah {

        $query = "select * from sekolah where id = ?";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$id]);
        $sekolah = new Sekolah();
        if($PDOStatement->rowCount()>0){
            while($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)){
                $sekolah->id = $row['id'];
                $sekolah->sekolah=$row['nama_sekolah'];
                $sekolah->jurusan=$row['jurusan'];
            }
            return $sekolah;
        }else{
            $sekolah=null;
            return $sekolah;
        }
    }
    public function save(Sekolah $sekolah) : Sekolah {
        $query = "insert into sekolah (nama_sekolah , jurusan ) values (? , ? )";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([
            $sekolah->sekolah,
            $sekolah->jurusan
        ]);
        return $sekolah;
    }

    public function deleteAll(){
        $this->connection->exec("delete from sekolah");
    }

    public function  update(Sekolah $sekolah) : Sekolah{
        $PDOStatement = $this->connection->prepare("update sekolah set nama_sekolah = ? , jurusan = ? where id = ?");
        $PDOStatement->execute([
            $sekolah->sekolah ,
            $sekolah->jurusan,
            $sekolah->id
        ]);
        return $sekolah;
    }
}