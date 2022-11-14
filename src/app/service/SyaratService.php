<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Syarat;
use LearnPhpMvc\dto\SyaratRequest;
use LearnPhpMvc\repository\SyaratRepository;

class SyaratService
{

    private SyaratRepository $repository;

    public function __construct()
    {
        $this->repository = new SyaratRepository(Database::getConnection());
    }

    public function addSyarat(SyaratRequest $syaratRequest): array
    {
        $syarat = new Syarat();
        $syarat->setSyarat($syaratRequest->getSyarat());
        $syarat->setId_magang($syaratRequest->getId_magang());
        $responseSave = $this->repository->save($syarat);
        $response = array();
        if ($responseSave == null) {
            $response['status'] = 'failed';
            $response['message'] = 'Terjadi kesalahan';
        } else {
            $response['status'] = 'oke';
            $response['message'] = 'berhasil menambahkan syarat';
            $item = array(
                'id' => $responseSave->getId(),
                'syarat' => $responseSave->getSyarat(),
                'magang' => $responseSave->getId_magang()
            );
            array_push($response, $item);
        }
        return $response;
    }

    public function showSyarat(SyaratRequest $syaratRequest): array
    {
        $syarat = new Syarat();
        $syarat->setId_magang($syaratRequest->getId_magang());
        return $this->repository->showSyarat($syarat);
    }

    public function updateSyarat(SyaratRequest $syaratRequest): array
    {
        $syarat = new Syarat();

        $syarat->setId($syaratRequest->getId());
        $syarat->setSyarat($syaratRequest->getSyarat());
        $syarat->setId_magang($syaratRequest->getId_magang());
        
        $response = array();
        $this->repository->updateSyarat($syarat);
        $response['status'] = 'oke';
        $response['message'] = 'berhasil memperbarui syarat';
        $item = array(
            "id" => $syarat->getId(),
            "syarat" => $syarat->getSyarat(),
            "id_magang" => $syarat->getId_magang()
        );
        array_push($response, $item);

        return $response;
    }

    public function findBySyarat(SyaratRequest $syaratRequest): array
    {
        $response = array();
        $syarat = new Syarat();
        $syarat->setId_magang($syaratRequest->getId_magang());
        $syarat->setSyarat($syaratRequest->getSyarat());
        $result = $this->repository->findBySyarat($syarat);
        if ($result == null) {
            $response['status'] = "failed";
            $response['message'] = "terjadi kesalahan gagal update skill";
        } else {
            $response['status'] = 'ok';
            $response['message'] = 'syarat ketemu';
            $response['body'] = array();
            $item = array(
                'id' => $result->getId(),
                'syarat' => $result->getSyarat(),
                'id_penyedia' => $result->getId_magang()
            );
            array_push($response['body'], $item);
        }
        return $response;
    }
    public function deleteSyarat(SyaratRequest $syaratRequest): array
    {
        $syarat = new Syarat();
        $syarat->setId_magang($syaratRequest->getId_magang());
        $arr = $this->repository->deleteByIdMagang($syarat);
        return $arr;
    }
}
