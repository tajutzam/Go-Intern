<?php

namespace LearnPhpMvc\repository;

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
        if($PDOstatement->rowCount()>0){
            $response['status'] = "ok";
            $response['body'] = array();
            while($row = $PDOstatement->fetch(PDO::FETCH_ASSOC)){
                $item = array(
                    'id' => $row['id'] , 
                    'kategori'=> $row['kategori']
                );
                array_push($response['body'] , $item);
            }
        }else{
            $response['status'] = 'failed';
            $response['message']='kategori not found';
        }
        return $response;
    }
}
