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
}
