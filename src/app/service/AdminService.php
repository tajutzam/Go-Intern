<?php

namespace LearnPhpMvc\service;

use Firebase\JWT\JWT;
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
    public function login($username, $password):array
    {
        $key = "asdaksljk kasjdkasjdaosdankjncjkscnuiopwedhujksjcjkdfhowehfiowehfjsdcnks";
        $response = [];
        $responseFind = $this->repository->findByUsername($username);
        if ($responseFind != null) {
            $checkPassword = password_verify($password, $responseFind->getPassword());
            if ($checkPassword) {
                $response['status'] = 'oke';
                $response['message'] = 'berhasil login';
                // var_dump($response[0]['username']);
                $payload = array(
                    "nama" => $responseFind->getNama(), 
                    "isLogin" => true 
                );
                $jwt =  JWT::encode($payload, $key, 'HS256');
                // set cockie
                setcookie("id", $responseFind->getId(), 0, "/");
                setcookie("GO-INTERN-ADMIN", $jwt, 0, "/");
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal login , harap check username atau password anda';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal login , Username atau password salah';
        }
        return $response;
    }
}
