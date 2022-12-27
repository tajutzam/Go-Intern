<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Domain\Kategori;
use PDO;

class KategoriRepository
{
    private PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    public function findAll(): array
    {
        $response = array();

        $query = "select * from kategori";

        $PDOstatement = $this->connection->query($query);
        if ($PDOstatement->rowCount() > 0) {
            $response['status'] = "ok";
            $response['body'] = array();
            while ($row = $PDOstatement->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['id'],
                    'kategori' => $row['kategori'],
                    'foto' => $row['foto'] ?? "tidak ada foto"
                );
                array_push($response['body'], $item);
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'kategori not found';
        }
        return $response;
    }

    public function addKategori(Kategori $kategori): ?Kategori
    {
        try {
            $query = "insert into kategori (kategori , foto) values (?  , ?)";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$kategori->getKategori(), $kategori->getFoto()]);
            return $kategori;
        } catch (\PDOException $th) {
            var_dump($th);
            return null;
        }
    }

    public function findByKategori($kategori): array
    {
        $response = [];
        $query = "select * from kategori where kategori = ?";
        $PDOSTatement = $this->connection->prepare($query);

        $PDOSTatement->execute([$kategori]);
        if ($PDOSTatement->rowCount() > 0) {
            $response['status'] = 'oke';
            $response['message'] = 'data kategori ditemukan';
            $response['body'] = [];
            while ($row = $PDOSTatement->fetch(PDo::FETCH_ASSOC)) {
                $item = [
                    "kategori" => $row['kategori'],
                    "foto" => $row['foto'],
                    "id" => $row['id']
                ];
                array_push($response['body'], $item);
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'data kategori tidak ditemukan';
        }
        return $response;
    }

    public function findById($id): ?Kategori
    {
        $query = "select * from kategori where id = ? ";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$id]);
        $kategori = new Kategori();
        if ($PDOStatement->rowCount() > 0) {
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $kategori->setKategori($row['kategori']);
            $kategori->setFoto($row['foto'] ?? "");
            $kategori->setId($row['id']);
            return $kategori;
        } else {
            return null;
        }
    }

    public function updateKategori(Kategori $kategori): ?Kategori
    {
        try {
            $query = "update kategori set kategori = ? , foto = ? where id = ?";
            $PDOStatemnt = $this->connection->prepare($query);
            $PDOStatemnt->execute([
                $kategori->getKategori(), $kategori->getFoto(), $kategori->getId()
            ]);
            return $kategori;
        } catch (\PDOException $th) {
            //throw $th;
            return null;
        }
    }

    public function deleteById($id): bool
    {
        try {
            $query = "delete from kategori where id = ?";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$id]);
            return true;
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        }
    }

    public function countKategori()
    {
        $query = "select * from kategori";
        $PDOStatemtn = $this->connection->query($query);
        return $PDOStatemtn->rowCount();
    }
}
