<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Otp;
use LearnPhpMvc\repository\OtpRepository;

class OtpService
{

    private OtpRepository $repository;


    public function __construct()
    {
        $this->repository = new OtpRepository(Database::getConnection());
    }
    public function save($kode, $pencari_magang): array
    {
        $response = [];
        $otpObj = new Otp();
        $otpObj->setPencari_magang($pencari_magang);
        $find = $this->repository->findByPencariMagang($otpObj);
        if ($find != null) {
            $response['status'] = 'failed';
            $response['message'] = 'user sudah memiliki kode otp';
        } else {
            $otp = new Otp();
            $otp->setOtp($kode);
            $otp->setPencari_magang($pencari_magang);
            $resultAdd = $this->repository->save($otp);
            if ($resultAdd != null) {
                $response['status'] = 'oke';
                $response['message'] = 'berhasil menambahkan otp';
                $response['otp'] = $kode;
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal menambahkan otp , terjadi kesalahan server';
            }
        }
        return $response;
    }



    public function resendOtp($idPencari, $kode): array
    {
        $otp = new Otp();
        $response = [];
        $otp->setPencari_magang($idPencari);
        $isDelete =  $this->repository->deleteOtpByPencariMagang($otp);
        if ($isDelete) {
            $otp->setOtp($kode);
            $resultAdd  =  $this->repository->save($otp);
            if($resultAdd!=null){
                $response['status'] = 'oke';
                $response['message'] = 'otp berhasil ditambahkan';
            }else{
                $respons['status'] = 'failed';
                $response['message'] = 'gagal menambahkan kode otp';
            }
        }
        return $response;
    }

    public function findByPencari($idPencari) : ?Otp{
        $otp = new Otp();
        $otp->setPencari_magang($idPencari);
        return $this->repository->findByPencariMagang($otp);
    }
}
