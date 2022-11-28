<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\dto\SkillRequest;
use LearnPhpMvc\service\SkillService;

class SkillController{
   
    private SkillService $service;

    public function __construct()
    {
        $this->service = new SkillService();
    }

    public function findAll(){
        $arr =  $this->service->findAll();
        echo json_encode($arr);
    }

    public function addSkill(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $request = new SkillRequest();
        $request->setSkill($jsonData['skill']);
        $request->setPencariMagang($jsonData['pencari_magang']);
        $arr = $this->service->addSkill($request);
        echo json_encode($arr);
    }

    public function update(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $request = new SkillRequest();
        $request->setSkill(ltrim($jsonData['skill']));
        $request->setPencariMagang($jsonData['pencari_magang']);
        $request->setId($jsonData['id']);
        $response = $this->service->update($request);
        echo json_encode($response);
    }

    public function findById() {
        $byid = $this->service->findByid();
        echo  json_encode($byid);
    }
    
    public function deleteSkillById(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $jsonData = json_decode(file_get_contents("php://input"), true);
        $responseDeleted = $this->service->deleteById($jsonData['id']);
        echo json_encode($responseDeleted);
    }
    
    public function showSkilsPencariMagang(){
        $path = $_SERVER['PATH_INFO'];
        $url = explode("/" , $path);
        $id = $url[4];
        $response = $this->service->findByPencariMagang($id);
        echo json_encode($response);
    }

}
