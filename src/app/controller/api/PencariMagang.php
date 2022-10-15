<?php

namespace LearnPhpMvc\controller\api;

class PencariMagang
{
    function findAll(): void
    {
        //get dari database dan masukan kedalam array , gunakan fetch_assoc
        $data = array(
            "data" => array(
                        array(
                            "id" => 1 ,
                            "nama" =>"zam"
                        ),
                array(
                    "id" => 2 ,
                    "nama" =>"zam"
                ),  array(
                    "id" => 3 ,
                    "nama" =>"zam"
                ),  array(
                    "id" => 4 ,
                    "nama" =>"zam"
                ),  array(
                    "id" => 5 ,
                    "nama" =>"zam"
                )
                    )
        );
        $data['succes']=true;
        http_response_code(200);
//      $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($data);
    }
}