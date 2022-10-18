<?php

namespace LearnPhpMvc\repository;

class PencariMagangRepository
{
    public \PDO $connection ;

    /**
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll() : array{
        $query = "select * from pencari_magang";
        $PDOStatement = $this->connection->query($query);
        $response = array();
        $response['status'] = "oke";
        $response['data'] = array();
        if ($PDOStatement->rowCount()>0) {
            while ($result = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($result);
                $item = array(
                    "id" => $id,
                    "username" => $username,
                    "password" => $password,
                    "email" => $email,
                    "id_sekolah" => $id_sekolah,
                    "no_telp" => $no_telp,
                    "agama" => $agama,
                    "tanggal_lahir" => $tanggal_lahir,
                    "token" => $token,
                    "cv" => $cv,
                    "resume" => $resume,
                    "status" => $status,
                    "status_magang" => $status_magang,
                    "role" => $role,
                    "crate_add" => $crate_add,
                    "update_add" => $update_add
                );
                array_push($response, $item);
            }
            http_response_code(200);
        }else{
            http_response_code(404);
            $response['body']=array(
                "status" => "data tidak ditemukan"
            );
        }
        return $response;
    }

    public function deleteAll(){
        $this->connection->exec("delete from pencari_magang");
    }

}