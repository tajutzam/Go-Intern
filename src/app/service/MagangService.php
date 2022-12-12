<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Magang;
use LearnPhpMvc\Domain\Syarat;
use LearnPhpMvc\dto\MagangRequest;
use LearnPhpMvc\dto\SyaratRequest;
use LearnPhpMvc\repository\MagangRepository;


class MagangService
{

    private MagangRepository $repository;
    private SyaratService $syaratService;

    public function __construct()
    {
        $this->repository = new MagangRepository(Database::getConnection());
        $this->syaratService = new SyaratService();
        $this->repository->updateStatusToPenuh();
        $this->repository->updateStatusToSebagian();
    }
    
    public function findAll(): array
    {
        $this->repository->updateStatusToSebagian();
        return $this->repository->findAll();
    }

    public function addMagang(MagangRequest $magangRequest): array
    {
        $this->repository->updateStatusToPenuh();
        $this->repository->updateStatusToSebagian();
        $response = array();
        $magang = new Magang();
        $magang->setPosisi_magang($magangRequest->getPosisi_magang());
        $magang->setPenyedia($magangRequest->getPenyedia());
        $magang->setJumlah_maksimal($magangRequest->getJumlah_maksimal());
        $magang->setLama_magang($magangRequest->getLama_magang());
        $magang->setDeskripsi($magangRequest->getDeskripsi());
        $magang->setKategori($magangRequest->getKategori());
        $magang->setSalary($magangRequest->getSalary());
        $resultOfSave =  $this->repository->addMagang($magang);
        if ($resultOfSave == null) {
            $response['status'] = 'failed';
            $response['message'] = 'terjadi kesalahan';
        } else {
            $response['status'] = 'oke';
            $response['message'] = 'Berhasil menambahkan data';
            $response['body'] = array();
            $item = array(
                'id' => $resultOfSave->getId(),
                'posisi_magang' => $resultOfSave->getPosisi_magang(),
                'penyedia' => $resultOfSave->getPenyedia(),
                'lama_magang' => $resultOfSave->getLama_magang(),
                'jumlah_maksimal' => $resultOfSave->getJumlah_maksimal(),
                'salary' => $magang->getSalary()
            );
            array_push($response['body'], $item);
            return $response;
        }
        return $response;
    }

    public function showMagang(MagangRequest $magangRequest): array
    {
        $this->repository->updateStatusToPenuh();
        $this->repository->updateStatusToSebagian();
        $magang = new Magang();
        $magang->setPenyedia($magangRequest->getPenyedia());
        return $this->repository->showMagang($magang);
    }

    public function updateData(MagangRequest $magangRequest): array
    {
        $this->repository->updateStatusToPenuh();
        $this->repository->updateStatusToSebagian();
        $magang = new Magang();
        $magang->setPosisi_magang($magangRequest->getPosisi_magang());
        $magang->setKategori($magangRequest->getKategori());
        $magang->setLama_magang($magangRequest->getLama_magang());
        $magang->setJumlah_maksimal($magangRequest->getJumlah_maksimal());
        $magang->setId($magangRequest->getId());
        $magang->setDeskripsi($magangRequest->getDeskripsi());
        $magang->setSalary($magangRequest->getSalary());
        $result = $this->repository->updateMagang($magang);
        $response = array();
        if ($result == null) {
            $response['status'] = "failed";
            $response['message'] = "gagal memperbarui data";
        } else {
            $response['status'] = 'oke';
            $response['message'] = 'berhasil memperbarui data magang';
            $item = array(
                "id" => $magang->getId(),
                "posisi_magang" => $magang->getPosisi_magang(),
                "kategori" => $magang->getKategori(),
                "lama_magang" => $magang->getLama_magang(),
                "jumlah_maksimal" => $magang->getJumlah_maksimal(),
                "deskripsi" => $magang->getDeskripsi()
            );
            array_push($response, $item);
        }
        return $response;
        // $magang->set
        // $this->repository->updateMagang();
    }

    public function deleteById(MagangRequest $magangRequest): array
    {

        $magang = new Magang();
        $magang->setId($magangRequest->getId());
        $response = array();
        $result = $this->repository->deleteById($magang);
        if ($result) {
            $response['status'] = "oke";
            $response['message'] = "berhasil delete";
        } else {
            $response['status'] = "failed";
            $response['message'] = "gagal hapus data magang";
        }
        return $response;
    }

    public function showMagangOnMobile(): array
    {
        $this->repository->updateStatusToSebagian();
        $this->repository->updateStatusToPenuh();
        $response = $this->repository->showMagangOnMobile();
        if ($response['status'] == "oke") {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        return $response;
    }
}
