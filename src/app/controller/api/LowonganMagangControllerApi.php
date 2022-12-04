<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\service\LowonganMagangService;

class LowonganMagangControllerApi
{

    private LowonganMagangService $service;

    public function __construct()
    {
        $this->service = new LowonganMagangService();
    }

    public function addLowonganMagang()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $id_magang = $jsonData['id_magang'];
        $id_pencariMagang = $jsonData['id_pencariMagang'];
        $id_penyediaMagang = $jsonData['id_penyediaMagang'];

        $response = $this->service->addLowongan($id_magang, $id_pencariMagang, $id_penyediaMagang);
        if ($response['status'] == 'success') {
            $responseMail = $this->service->sendEmailLamaran($id_penyediaMagang, $id_pencariMagang, $id_magang);
            $response['email'] = $responseMail;
        }
        echo json_encode($response);
    }

    public function updateSuratLamran()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $suratLamaran = $jsonData['surat_lamaran'];
        $id = $jsonData['id'];
        $response = $this->service->updateSuratLamaran($suratLamaran, $id);
        echo json_encode($response);
    }
}
