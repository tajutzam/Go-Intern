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

    public function deleteAll(): void
    {
        $this->connection->exec("delete from sekolah");
    }

    public function findAll(): array
    {
        $query = "select id , nama_sekolah from sekolah";
        $PDOStatement = $this->connection->query($query);
        $response = array();
        $response['data'] = array();
        if ($PDOStatement->rowCount() > 0) {
            http_response_code(200);
            $response['status'] = "ok";
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $s = array(
                    "id" => $id,
                    "nama_sekolah" => $nama_sekolah,
                );
                array_push($response['data'], $s);
            }
        } else {
            http_response_code(404);
            $response['status'] = "failed";
        }
        return $response;
    }

    public function findById(int $id): ?Sekolah
    {
        $query = "select * from sekolah where id = ?";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$id]);
        $sekolah = new Sekolah();
        if ($PDOStatement->rowCount() > 0) {
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                $sekolah->id = $row['id'];
                $sekolah->sekolah = $row['nama_sekolah'];
            }
            return $sekolah;
        } else {
            return null;
        }
    }

    public function save(Sekolah $sekolah): ?Sekolah
    {
        try {
            $query = "insert into sekolah (nama_sekolah) values (?)";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([
                $sekolah->sekolah
            ],);
            $sekolah->id = $this->connection->lastInsertId();
            return $sekolah;
        } catch (\PDOException $th) {
            var_dump($th);
            return null;
        }
    }

    public function  update(Sekolah $sekolah): ?Sekolah
    {
        $sekolahFindById = $this->findById($sekolah->id);
        if ($sekolahFindById == null) {
            return null;
        } else {
            $PDOStatement = $this->connection->prepare("update sekolah set nama_sekolah = ? where id = ?");
            $PDOStatement->execute([
                $sekolah->sekolah,
                $sekolah->id
            ]);
            return $sekolah;
        }
    }

    public function deleteById($id): bool
    {
        try {
            $PDOStatement = $this->connection->prepare("delete from sekolah where id = ?");
            $PDOStatement->execute([$id]);
            return true;
        } catch (\PDOException $PDOException) {


            return false;
        }
    }

    public function findBySekolah(Sekolah $sekolah): ?Sekolah
    {
        try {
            $query = "select * from sekolah where nama_sekolah = ? ";
            $result = $this->connection->prepare($query);
            $result->execute([$sekolah->sekolah]);
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                    $sekolah->sekolah = $row['nama_sekolah'];
                    $sekolah->id = $row['id'];
                }
                return $sekolah;
            } else {
                return null;
            }
        } catch (\PDOException $th) {
            var_dump($th);
            return null;
        }
    }

    public function addJurusan(Sekolah $sekolah) : ?Sekolah
    {
        try {

            $query  = "insert into jurusan_sekolah (sekolah , jurusan) values (? , ?)";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$sekolah->id, $sekolah->jurusan]);
            return $sekolah;
        } catch (\PDOException $th) {
            //throw $th;
            var_dump($th);
            return null;
        }
    }
}
