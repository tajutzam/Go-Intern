<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Domain\Role;
use LearnPhpMvc\Exeptions\ValidationExeptions;
use function PHPUnit\Framework\at;

class RoleRepository
{
    private \PDO $connection;
    public function __construct(\PDO $pdo)
    {
        $this->connection = $pdo;
    }
    public function save(Role $role) : Role {
        $query = "insert into role (role) values (?)";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            $role->getRole()
        ]);
        return $role;
    }
    public function deleteAll() : Void {
        $query = "delete from role where 1";
        $this->connection->exec($query);
    }
    public function  findById($id) : ?Role{
        $result = array();
        $query = "select id, role from role where id = ?";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$id]);
        if($PDOStatement->rowCount() > 0){
            $role = new Role();
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)){
                $role->setRole($row['role']);
                $role->setId($row['id']);
            }
            return $role;
        }else{
            return null;
        }
    }

    public function findAll() : ?array{
        $result = array();
        $query = "select * from role";
        $PDOStatement = $this->connection->query($query);
        $response = array();
        $response['body'] = array();
        if($PDOStatement->rowCount()>0){
            $response['status'] = "oke";
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)){
                extract($row);
                $s= array(
                    "id" => $id ,
                    "role" => $role
                );
                array_push($response['body'] , $s);
            }
            return $response;
        }else{
            return null;
        }
    }

    public function update($role , $id) : array{
        $result = array();
        $query = "update role set role = ? where id = ?";
        $roleUser = $this->findById($id);
        if($roleUser==null){
            $result= array(
              "status" => "data tidak ditemukan"
            );
        }else{
            try {
                $PDOStatement = $this->connection->prepare($query);
                $PDOStatement->execute([$role , $id]);
                return array(
                    "status" => "data berhasil di update"
                );
            }catch (\PDOException $pdo){
                http_response_code(400);
                return array(
                    "status" => "terjadi kesalahan"
                );
            }
        }
        return $result;
    }
}