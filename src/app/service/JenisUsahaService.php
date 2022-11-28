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

    public function findAll(): array
    {
        $arr = $this->repository->findAll();
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

    public function findById(JenisUsaha $jenisUsaha): array
    {
        $response = array();

        $responseTemp = $this->repository->findById($jenisUsaha);
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
}
