<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\JenisUsaha;
use LearnPhpMvc\dto\SearchKeyword;
use LearnPhpMvc\repository\JenisUsahaRepository;

class JenisUsahaService
{

    private  JenisUsahaRepository $repository;

    public function __construct()
    {
        $this->repository = new JenisUsahaRepository(Database::getConnection());
    }

    public function findAllGet()
    {
        $arr = $this->repository->findAllGet();
        return $arr;
    }

    public function findAll($jenis_usaha): array
    {
        $arr = $this->repository->findAll($jenis_usaha);
        return $arr;
    }
    public function findByJenis(SearchKeyword $keyword): ?array
    {
        $usaha = new JenisUsaha();
        $usaha->setJenis($keyword->getKeyword());
        $result  = $this->repository->findByJenisUsaha($usaha);
        $response = array();
        if ($result == null) {
            $response['status'] = "failed";
            $response['message'] = "skill tidak ditemukan";
            return $response;
        } else {
            $response['status'] = "ok";
            $response['message'] = "skill ditemukan";
            $response['data'] = $result;
            return $response;
        }
    }

    public function findById($id): array
    {
        $response = array();
        $responseTemp = $this->repository->findById($id);
        if ($responseTemp == null) {
            $response['status'] = "failed";
            $response['message'] = "gagal menemukan jenis usaha";
        } else {
            $response['status'] = "ok";
            $response['message'] = "data ketemu";
            $response['body'] = array();
            $item = array(
                "id" => $responseTemp->getId(),
                "jenis_usaha" => $responseTemp->getJenis()
            );

            array_push($response['body'], $item);
        }
        return $response;
    }

    public function showAll()
    {
        $response = $this->repository->showAll();
        return $response;
    }


    public function addJenis($jenis): array
    {
        $jenisObj = new JenisUsaha();
        $jenisObj->setJenis($jenis);

        $response = [];
        $responseFindJenisUsaha = $this->repository->findByJenisUsaha($jenisObj);
        if ($responseFindJenisUsaha != null) {
            $response['status'] = 'failed';
            $response['message'] = 'gagal menambahkan jenis usaha yang sudah tersedia';
        } else {
            $responseSave = $this->repository->save($jenisObj);
            if ($responseSave != null) {
                $response['status'] = 'oke';
                $response['message'] = 'berhasil menambahkan jenis usaha';
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal menambahkan jenis usaha';
            }
        }
        return $response;
    }

    public function update($jenisUsaha, $id): array
    {
        $response = [];
        $responseFind = $this->repository->findById($id);
        if ($responseFind != null) {
            $jenisUsahaFind = new JenisUsaha();
            $jenisUsahaFind->setJenis($jenisUsaha);
            $jenisUsahaFind->setId($id);
            $resultFindJenisUSaha = $this->repository->findByJenisUsaha($jenisUsahaFind);
            if ($resultFindJenisUSaha != null) {
                $response['status'] = 'failed';
                $response['message'] = 'gagal memperbarui jenis usaha, tidak ada perubahan data  atau jenis usaha sudah digunakan';
            } else {
                $responseUpdate = $this->repository->update($jenisUsahaFind);
                if ($responseUpdate != null) {
                    $response['status'] = 'oke';
                    $response['message'] = 'berhasil memperbarui jenis usaha';
                } else {
                    $response['status'] = 'failed';
                    $response['message'] = 'gagal memperbarui jenis usaha , terjadi kesalahan server';
                }
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal memperbarui jenis usaha , id tidak ditemukan';
        }
        return $response;
    }

    public function deleteJenis($id): array
    {
        $response = [];
        $responseFind = $this->repository->findById($id);
        if ($responseFind != null) {
            $responseDelete = $this->repository->deleteById($id);
            if ($responseDelete) {
                $response['status'] = 'oke';
                $response['message'] = 'berhasil menghapus jenis usaha';
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal menghapus jenis usaha , jenis usaha digunakan oleh penyedia';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal menghapus jenis usaha , jenis usaha tidak ditemukan';
        }
        return $response;
    }

    public function count(){
        return $this->repository->countJenis();
    }
}
