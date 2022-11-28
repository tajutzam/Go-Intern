<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Domain\Jurusan;

class JurusanRepository
{

    private \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $query = "select * from jurusan ";
        $PDOstatement = $this->connection->query($query);
        $response = array();
        if ($PDOstatement->rowCount() > 0) {
            http_response_code(200);
            $response['status'] = 'oke';
            $response['body'] = array();
            while ($row = $PDOstatement->fetch(\PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['id'],
                    'jurusan' => $row['jurusan']
                );
                array_push($response['body'], $item);
            }
        } else {
            $response['status'] = 'failed';
            http_response_code(404);
        }
        return $response;
    }

    public function findById($id): ?Jurusan
    {
        $jurusan = new Jurusan();
        $query = "select * from jurusan where id = ?";
        $PDOstatement = $this->connection->prepare($query);
        $PDOstatement->execute([$id]);
        if ($PDOstatement->rowCount() > 0) {
            $row = $PDOstatement->fetch(\PDO::FETCH_ASSOC);
            $jurusan->setId($row['id']);
            $jurusan->setJurusan($row['jurusan']);
            return $jurusan;
        } else {
            return null;
        }
    }

    public function findByJurusan($jurusan): ?Jurusan
    {
        $jurusanSt = new Jurusan();
        $query = "select * from jurusan where jurusan = ?";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$jurusan]);
        if($PDOStatement->rowCount()>0){
            $row = $PDOStatement->fetch(\PDO::FETCH_ASSOC);
            $jurusanSt->setId($row['id']);
            $jurusanSt->setJurusan($row['jurusan']);
            return $jurusanSt;
        }else{
            return null;
        }
    }
}
