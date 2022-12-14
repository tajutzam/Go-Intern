<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\dto\SyaratRequest;
use LearnPhpMvc\service\MagangService;
use LearnPhpMvc\service\SyaratService;

class MagangControllerApi
{

    // service magang 

    private MagangService $service;
    private SyaratService $syaratService;

    public function __construct()
    {
        $this->service = new MagangService();
        $this->syaratService = new SyaratService();
    }

    public function showMagangInMobile()
    {
        $response = $this->service->showMagangOnMobile();
        if ($response['status'] == "oke") {
            foreach ($response['body'] as $key => $value) {
                # code...
                $id = $value['id_magang'];
                $syarat = new SyaratRequest();
                $syarat->setId_magang($id);
                $dataSyarat = $this->syaratService->showSyarat($syarat);
                $response['body'][$key]['syarat'] = array();
                array_push($response['body'][$key]['syarat'], $dataSyarat['body']);
            }
        }
        echo json_encode($response);
    }

    public function showMagangOnMobileByPenyedia()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $idPenyedia = $jsonData['idPenyedia'];
        $response = $this->service->showMagangOnMobileByPenyedia($idPenyedia);
        if ($response['status'] == 'oke') {
            foreach ($response['body'] as $key => $value) {
                $id = $value['id_magang'];
                $syarat = new SyaratRequest();
                $syarat->setId_magang($id);
                $dataSyarat = $this->syaratService->showSyarat($syarat);
                $response['body'][$key]['syarat'] = array();
                array_push($response['body'][$key]['syarat'], $dataSyarat['body']);
            }
        }
        echo json_encode($response);
    }

    public function showMagangOnMobileByKategori()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $kategori = $jsonData['kategori'];
        $response = $this->service->showMagangOnMobileByKategori($kategori);
        if ($response['status'] == 'oke') {
            foreach ($response['body'] as $key => $value) {
                $id = $value['id_magang'];
                $syarat = new SyaratRequest();
                $syarat->setId_magang($id);
                $dataSyarat = $this->syaratService->showSyarat($syarat);
                $response['body'][$key]['syarat'] = array();
                array_push($response['body'][$key]['syarat'], $dataSyarat['body']);
            }
        }
        echo json_encode($response);
    }

    
}
