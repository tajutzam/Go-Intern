<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Domain\Syarat;
use PDO;

class SyaratRepository
{


    private PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    public function save(Syarat $syarat): ?Syarat
    {

        $query = "insert into syarat (syarat , id_magang) values (? , ?)";

        $PDOstatment = $this->connection->prepare($query);
        try {
            //code...
            $this->connection->beginTransaction();
            $PDOstatment->execute([$syarat->getSyarat(), $syarat->getId_magang()]);
            $syarat->setId($this->connection->lastInsertId());
            $this->connection->commit();
            return $syarat;
        } catch (\PDOException $th) {
            var_dump($th);
            $this->connection->rollBack();
            return null;
        }
    }

    public function showSyarat(Syarat $syarat): array
    {
        $query = "select id_syarat , syarat from syarat where id_magang = ?";
        $PDOstatement = $this->connection->prepare($query);
        $PDOstatement->execute([$syarat->getId_magang()]);
        $response = array();
        if ($PDOstatement->rowCount() > 0) {
            $response['status'] = "oke";
            $response['body'] = array();
            while ($row = $PDOstatement->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    "id" => $id_syarat,
                    "syarat" => $syarat
                );
                array_push($response['body'], $item);
            }
            return $response;
        } else {
            $response['status'] = "failed";
            $response['message'] = "syarat tidak ketemu";
            return $response;
        }
    }

    public function updateSyarat(Syarat $syarat): ?Syarat
    {
        $query = "update syarat set syarat = ? where id_syarat = ?";
        try {
            $PDOstatement = $this->connection->prepare($query);
            $PDOstatement->execute([$syarat->getSyarat(), $syarat->getId()]);
            return $syarat;
        } catch (\PDOException $th) {
            var_dump($th);
            return null;
        }
    }

    public function findById(Syarat $syarat): ?Syarat
    {
        $query = "select * from syarat where id_magang = ?";
        $PDOstatement = $this->connection->prepare($query);
        $PDOstatement->execute([$syarat->getId()]);
        if ($PDOstatement->rowCount() > 0) {
            $row = $PDOstatement->fetch(PDO::FETCH_ASSOC);
            $syarat->setId($row['id_syarat']);
            $syarat->setId_magang($row['id_magang']);
            $syarat->setSyarat($row['syarat']);
            return $syarat;
        } else {
            return null;
        }
    }
    public function findBySyarat(Syarat $syarat): ?Syarat
    {
        $query = "select * from syarat where syarat = ? and id_magang  = ? ";
        $PDOstatement = $this->connection->prepare($query);
        $PDOstatement->execute([$syarat->getSyarat(), $syarat->getId_magang()]);
        if ($PDOstatement->rowCount() > 0) {
            $row = $PDOstatement->fetch(PDO::FETCH_ASSOC);
            $syarat->setId($row['id_syarat']);
            $syarat->setId_magang($row['id_magang']);
            $syarat->setSyarat($row['syarat']);
            return $syarat;
        } else {
            return null;
        }
    }

    public function deleteByIdMagang(Syarat $syarat): array
    {
        $response = array();
        try {
            $query = "delete from syarat where id_magang = ?";
            $resultOfDelete = $this->connection->prepare($query);
            $resultOfDelete->execute([$syarat->getId_magang()]);
            $response['status'] = "succes";
        } catch (\PDOException $th) {
            //throw $th;
            var_dump($th);
            $response['status'] = 'failed';
        }
        return $response;
    }
}
