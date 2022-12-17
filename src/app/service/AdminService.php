<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Admin;
use LearnPhpMvc\repository\AdminRepository;

class AdminService
{


    private AdminRepository $repository;


    public function __construct()
    {
        $this->repository = new AdminRepository(Database::getConnection());
    }

    public function register($username, $password, $nama): array
    {
        $admin = new Admin();
        $dateNow =   date("Y-m-d");
        $response = [];
        $responseFind =  $this->repository->findByUsername($username);
        if ($responseFind != null) {
            $response['status'] = 'failed';
            $response['message'] = 'Gagal regristasi username sudah digunakan';
        } else {
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $admin->setPassword($hashed);
            $admin->setUsername($username);
            $admin->setNama($nama);
            $admin->setCreate_at($dateNow);
            $admin->setUpdate_at($dateNow);
            $responseRegister =  $this->repository->save($admin);
            if ($responseRegister != null) {
                $response['status'] = 'oke';
                $response['message'] = 'Berhasil Regristasi Silahkan login ';
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal Regristasi terjadi kesalahan';
            }
        }
        return $response;
    }
}
