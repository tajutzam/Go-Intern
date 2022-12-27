<?php


namespace LearnPhpMvc\service;

use LearnPhpMvc\Domain\Jurusan;
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
                "jurusan" => $responseObj->getJurusan()
            );
            array_push($response['body'], $item);
        } else {
            $response['status'] = "Failed";
            $response['message'] = "data jurusan tidak ketemu";
        }
        return $response;
    }

    public function findByJurusan($jurusan): array
    {
        $response  = array();
        $responseObj = $this->repository->findByJurusan($jurusan);
        if ($responseObj != null) {
            $response['status'] = "oke";
            $response['message'] = "jurusan ditemukan";
            $response['body'] = array();
            $item = array(
                "id" => $responseObj->getId(),
                "jurusan" => $responseObj->getJurusan()
            );
            array_push($response['body'], $item);
        } else {
            $response['status'] = "oke";
            $response['message'] = "jurusan tidak ditemukan";
        }
        return $response;
    }

    public function save($jurusan): array
    {
        $response = array();

        $responseFind =  $this->repository->findByJurusan($jurusan);
        if ($responseFind != null) {
            $response['status'] = 'failed';
            $response['message'] = 'gagal menambahkan jurusan , jurusan sudah ada';
        } else {
            $jurusanObj = new Jurusan();
            $jurusanObj->setJurusan($jurusan);
            $responseInsert = $this->repository->save($jurusanObj);
            if ($responseInsert != null) {
                $response['status'] = 'success';
                $response['message'] = 'berhasil menambahkan jurusan';
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal menambahkan jurusan';
            }
        }
        return $response;
    }

    public function updateJurusan($jurusan, $id): array
    {
        $response = array();
        $responseFind = $this->repository->findByJurusan($jurusan);
        if ($responseFind != null) {
            $response['status'] = 'failed';
            $response['message'] = 'gagal memperbarui jurusan , tidak ada perubahan';
        } else {
            $jurusanObj = new Jurusan();
            $jurusanObj->setJurusan($jurusan);
            $jurusanObj->setId($id);
            $responseUpdate = $this->repository->update($jurusanObj);
            if ($responseUpdate) {
                $response['status'] = 'oke';
                $response['message'] = 'berhasil memperbarui jurusan';
            } else {
                $response['status'] = 'failed';
                $response['messagge'] = 'gagal memperbarui  jurusan terjadi kesalahan';
            }
        }
        return $response;
    }

    public function delete($id) : array
    {
        $resultFind = $this->repository->findById($id);
        $response = array();
        if ($resultFind != null) {
            $jurusan = new Jurusan();
            $jurusan->setId($id);
            $responsedelete = $this->repository->deleteJurusan($jurusan);
            if($responsedelete){
                $response['status'] = 'oke';
                $response['message'] = 'berhasil menghapus data jurusan';
            }else{
                $response['status'] = 'failed';
                $response['message'] = 'gagal menghapus jurusan , terhubung dengan data pencari magang';
            }   
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal menghapus data jurusan , data jurusan tidak ditemukan';
        }
        return $response;
    }

    public function count(){
        return $this->repository->countJurusan();
    }
}
