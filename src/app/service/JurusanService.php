<?php


namespace LearnPhpMvc\service;

use LearnPhpMvc\repository\JurusanRepository;

class JurusanService
{


    private JurusanRepository $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById($id): array
    {
        $response = array();
        $response['body']  = array();
        $responseObj = $this->repository->findById($id);
        if ($responseObj  != null) {
            $response['status'] = "oke";
            $response['message'] = "data jurusan ketemu";
            $item = array(
                "id" => $responseObj->getId(),
                "jurusan" =>$responseObj->getJurusan()
            );
            array_push($response['body'] , $item);
        }else{
            $response['status'] ="Failed";
            $response['message'] ="data jurusan tidak ketemu";
        }
        return $response;
    }

    public function findByJurusan($jurusan) : array{
        $response  = array();
        $responseObj = $this->repository->findByJurusan($jurusan);
        if($responseObj != null){
            $response['status'] = "oke";
            $response['message'] = "jurusan ditemukan";
            $response['body'] = array();
            $item =array(
                "id" => $responseObj->getId() , 
                "jurusan" =>$responseObj->getJurusan()
            );
            array_push($response['body'] , $item);
        }else{
            $response['status'] = "oke";
            $response['message'] = "jurusan tidak ditemukan";
        }
        return $response;
    }
}
