<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\Penghargaan;
use LearnPhpMvc\repository\PenghargaanRepository;

class PenghargaanService
{

    private PenghargaanRepository $repository;


    public function __construct()
    {
        $this->repository = new PenghargaanRepository(Database::getConnection());
    }

    public function addPenghargaan($judul, $file, $pencari_magang): array
    {
        $penghargaan = new Penghargaan();
        $penghargaan->setJudul($judul);
        $penghargaan->setFile($file);
        $penghargaan->setPencari_magang($pencari_magang);
        $responseBool =  $this->repository->addPenghargaan($penghargaan);
        $response = array();

        if ($responseBool) {
            $response['status'] = 'oke';
        } else {
            $response['status']  = 'failed';
        }
        return $response;
    }

    public function findById($idPenghargaan): array
    {
        $penhargaan = new Penghargaan();
        $penhargaan->setId_penghargaan($idPenghargaan);
        $dataObj =  $this->repository->findById($penhargaan);
        $response = array();
        $response['body'] = array();
        if ($dataObj == null) {
            http_response_code(404);
            $response['status'] = 'failed';
            $response['message'] = 'user tidak memiliki penghargaan';
        } else {
            http_response_code(200);
            $response['status'] = 'ok';
            $response['message'] = 'user memiliki penghargaan';
            $item = array(
                "id" => $dataObj->getId_penghargaan(),
                "judul" => $dataObj->getJudul(),
                "file" => $dataObj->getFile(),
            );
            array_push($response['body'], $item);
        }
        return $response;
    }

    public function findByPencariMagang($id) : array{
        $pencariMagang = new PencariMagang();
        $pencariMagang->setId($id);
        $response = $this->repository->findByPencariMagang($pencariMagang);
        return $response;
    }
}
