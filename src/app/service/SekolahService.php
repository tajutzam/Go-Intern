<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Sekolah;
use LearnPhpMvc\repository\JurusanRepository;
use LearnPhpMvc\repository\SekolahRepository;

class SekolahService
{
    private SekolahRepository $sekolahRepository;
    private JurusanService $jurusanService;
    public function __construct()
    {
        $this->sekolahRepository = new SekolahRepository(Database::getConnection());
        $jurusanrepo = new JurusanRepository(Database::getConnection());
        $this->jurusanService = new JurusanService($jurusanrepo);
    }

    public function findAll(): array
    {
        $response =  $this->sekolahRepository->findAll();
        return $response;
    }

    public function insertSekolah(Sekolah $sekolah): array
    {

        $responseFind =  $this->sekolahRepository->findBySekolah($sekolah);
        if ($responseFind != null) {
            http_response_code(400);
            $response['status'] = "failed";
            $response['message'] = "data sekolah sudah ada";
        } else {
            $sekolahObj = $this->sekolahRepository->save($sekolah);
            $response = array();
            if ($sekolahObj != null) {
                http_response_code(200);
                $response['status'] = "oke";
                $response['message'] = "Sekolah Berhasil ditambahkan";
                $response['body'] = array();
                $item = array(
                    "id" => $sekolahObj->id,
                    "sekolah" => $sekolahObj->sekolah,
                );
                array_push($response['body'], $item);
            } else {
                http_response_code(500);
                $response['status'] = "failed";
                $response['message'] = "Gagal tambah sekolah , terjadi kesalahan";
            }
        }
        return $response;
    }

    public function addJurusan($sekolah, $jurusan): array
    {
        $responseJurusan = $this->jurusanService->findById($jurusan);
        $response = array();
        $sekolahObj = new Sekolah();
        if ($responseJurusan['status'] == "oke") {
            $sekolahObj->id = $sekolah;
            $sekolahObj->jurusan = $jurusan;
            $responseObj = $this->sekolahRepository->addJurusan($sekolahObj);
            if ($responseObj != null) {
                http_response_code(200);
                $response['status'] = "oke";
                $response['message'] = "berhasil menambahkan jurusan ke sekolah";
            } else {
                http_response_code(500);
                $response['status'] = "failed";
                $response['message'] = "Gagal menambahkan jurusan , terjadi kesalahan pada server";
            }
        } else {
            $response['status'] = "failed";
            $response['message'] = "data jurusan tidak ada";
        }
        return $response;
    }

    public function findBySekolah($sekolah): array
    {
        $sekolahObj = new Sekolah();
        $sekolahObj->sekolah = $sekolah;
        $response = array();
        $response['body'] = array();
        $responseSearch = $this->sekolahRepository->findBySekolah($sekolahObj);
        if ($responseSearch != null) {
            $response['status'] = "oke";
            $response['message'] = "sekolah ditemukan";
            $item = array(
                "id" => $sekolahObj->id,
                "sekolah" => $sekolahObj->sekolah
            );
            array_push($response['body'], $item);
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'data sekolah tidak ditemukan';
        }

        return $response;
    }

    public function update($sekolah, $id): array
    {
        $response = array();
        $responseFind = $this->sekolahRepository->findById($id);
        if ($responseFind != null) {
            $sekolahObj = new Sekolah();
            $sekolahObj->sekolah = $sekolah;
            $sekolahObj->id = $id;
            if ($responseFind->sekolah == $sekolahObj->sekolah) {
                $response['status'] = 'failed';
                $response['message'] = 'gagal memperbarui sekolah , tidak ada perubahan';
            } else {
                $responseUpdate = $this->sekolahRepository->update($sekolahObj);
                if ($responseUpdate != null) {
                    $response['status'] = 'oke';
                    $response['message'] = 'berhasil memperbarui sekolah';
                } else {
                    $response['status'] = 'failed';
                    $response['message'] = 'gagal memperbarui sekolah terjadi kesalahan server';
                }
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal memperbarui sekolah , data sekolah tidak ditemukan';
        }
        return $response;
    }
    public function delete($id): array
    {
        $response = array();
        $responseFind = $this->sekolahRepository->findById($id);
        if ($responseFind != null) {
            $responsedelete = $this->sekolahRepository->deleteById($id);
            if ($responsedelete) {
                $response['status'] = 'oke';
                $response['message'] = "berhasil menghapus sekolah";
            } else {
                $response['status'] = 'faileed';
                $response['message'] = "gagal menghapus sekolah , terdapat data pencari magang yang terhubung dengan sekolah";
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = "gagal menghapus sekolah , data sekolah tidak ditemukan";
        }
        return $response;
    }

    public function count(){
        return $this->sekolahRepository->countSekolah();
    }
}
