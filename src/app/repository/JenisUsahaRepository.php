<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Domain\JenisUsaha;

class JenisUsahaRepository
{

    private \PDO $connection;

    /**
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll($jenis_usaha): array
    {
        $query = <<<SQL
        select  * from jenis_usaha where jenis != ?
SQL;
        $response = array();
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$jenis_usaha]);
        if ($PDOStatement->rowCount() > 0) {
            $response['status'] = "ok";
            $response['body'] = array();
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    "id"  => $id,
                    "jenis" => $jenis
                );
                array_push($response['body'], $item);
            }
        } else {
            $response['status'] = "failed";
        }
        return $response;
    }

    public function save(JenisUsaha $jenisUsaha): ?JenisUsaha
    {

        try {
            $query = <<<SQL
        insert  into jenis_usaha (jenis) values (?)
SQL;
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$jenisUsaha->getJenis()]);
            $jenisUsaha->setId($this->connection->lastInsertId());
            return $jenisUsaha;
        } catch (\PDOException $exception) {
            return null;
        }
    }

    public function findAllGet(): array
    {
        $query = <<<SQL
        select  * from jenis_usaha
SQL;
        $response = array();
        $PDOStatement = $this->connection->query($query);
        if ($PDOStatement->rowCount() > 0) {
            $response['status'] = "ok";
            $response['body'] = array();
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    "id"  => $id,
                    "jenis" => $jenis
                );
                array_push($response['body'], $item);
            }
        } else {
            $response['status'] = "failed";
        }
        return $response;
    }


    public function findByJenisUsahaLike(JenisUsaha $jenisUsaha): array
    {
        try {
            $query = <<<SQL
        select * from jenis_usaha where jenis  LIKE CONCAT('%',?,'%')
SQL;
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$jenisUsaha->getJenis()]);
            $response = array();
            $response['body'] = array();
            if ($PDOStatement->rowCount() > 0) {
                $response['status'] =  "ok";
                $response['message'] = "terdapat " . $PDOStatement->rowCount() . " Jenis usaha";
                while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                    extract($row);
                    $item = array(
                        "id"  => $id,
                        "jenis" => $jenis
                    );
                    array_push($response['body'], $item);
                }
                return $response;
            } else {
                $response['status'] = "failed";
                $response['message'] = "jenis usaha tidak ada";
            }
        } catch (\PDOException $exception) {
            return $response;
        }
        return $response;
    }
    public function findByJenisUsaha(JenisUsaha $jenisUsaha): ?JenisUsaha
    {
        try {
            $query = <<<SQL
        select * from jenis_usaha where jenis = ?
SQL;
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$jenisUsaha->getJenis()]);

            if ($PDOStatement->rowCount() > 0) {
                while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                    extract($row);
                    $jenisUsaha->setJenis($jenis);
                    $jenisUsaha->setId($id);
                }
                return $jenisUsaha;
            } else {
                return null;
            }
        } catch (\PDOException $exception) {
            return null;
        }
    }

    public function findById($id): ?JenisUsaha
    {
        $jenisUsaha = new JenisUsaha();
        try {
            $query = <<<SQL
        select * from jenis_usaha where id = ?
SQL;
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$id]);
            if ($PDOStatement->rowCount() > 0) {
                while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                    extract($row);
                    $jenisUsaha->setJenis($jenis);
                    $jenisUsaha->setId($id);
                }
                return $jenisUsaha;
            } else {
                return null;
            }
        } catch (\PDOException $exception) {
            return null;
        }
    }

    public function update(JenisUsaha $jenisUsaha): ?JenisUsaha
    {
        try {
            $query = <<<SQL
        update jenis_usaha set jenis = ? where id = ?
SQL;
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$jenisUsaha->getJenis(), $jenisUsaha->getId()]);
            return $jenisUsaha;
        } catch (\PDOException $exception) {
            return null;
        }
    }
}
