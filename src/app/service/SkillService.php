<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Skill;
use LearnPhpMvc\dto\SkillRequest;
use LearnPhpMvc\repository\SkillRepository;

class SkillService
{
    private SkillRepository $repository;
    public function __construct()
    {
        $this->repository = new SkillRepository(Database::getConnection());
    }
    public function findAll(): array
    {
        $arr = $this->repository->findAll();
        if ($arr['status'] === "ok") {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        return $arr;
    }
    public function addSkill(SkillRequest $request): array
    {
        $response = array();
        $skill = new Skill();
        $skill->setSkill($request->getSkill());
        $skill->setPencari_magang($request->getPencariMagang());
        $bySkill = $this->repository->findBySkill($skill);
        try {
            if ($bySkill == null) {
                $this->repository->save($skill);
                http_response_code(200);
                $response['status'] = "ok";
                $response['message'] = "berhasil menambahkan skill";
            } else {
                http_response_code(400);
                $response['status'] = "failed";
                $response['message'] = "Skill sudah ada pada ";
            }
        } catch (\Exception $exception) {
            http_response_code(500);
            $response['status'] = "failed";
            $response['message'] = $exception->getMessage();
        }
        return $response;
    }
    public function update(SkillRequest $request): array
    {
        $response = array();
        $skillData = new Skill();
        $byId = $this->repository->findById($request->getId());
        if ($byId == null) {
            $response['message'] = "skill tidak ada";
            $response['status'] = "failed";
        } else {
            $skillData->setSkill($request->getSkill());
            $skillData->setPencari_magang($request->getPencariMagang());
            $skillData->setId($request->getId());
            $skills = $skillData->getSkill();
            if ($skills == "") {
                $response['status'] = "failed";
                $response['message'] = "Field Skill tidak boleh kosong";
            } else {
                if ($request->getSkill() === $byId->getSkill()) {
                    $response['status'] = "failed";
                    $response['message'] = "Gagal Memperbarui skill , tidak ada perubahan data";
                } else {
                    $this->repository->update($skillData);
                    $response['status'] = "ok";
                    $response['message'] = "Berhasil memperbarui skill";
                }
                return $response;
            }
        }
        return $response;
    }

    public function findByid(): array
    {
        $response = array();
        $path = $_SERVER['PATH_INFO'];
        $data = explode("/", $path);
        $response['body'] = array();
        $byId = $this->repository->findById($data[4]);
        if ($byId == null) {
            $response['status'] = "failed";
            $response['message'] = "tidak ada data skill";
        } else {
            $response['status'] = "ok";
            $response['message'] = "data ketemu";
            $item = array(
                "id" => $byId->getId(),
                "skill" => $byId->getSkill(),
                "pencari_magang" => $byId->getPencari_magang()
            );
            array_push($response['body'], $item);
        }
        return $response;
    }

    public function deleteById($id): array
    {
        $skill = new Skill();
        $skill->setId($id);
        $find = $this->repository->findById($id);
        if ($find != null) {
            $deletebyId = $this->repository->deletebyId($skill);
            $response = array();
            if ($deletebyId) {
                http_response_code(200);
                $response['status'] = "ok";
                $response['message'] = "succes delete skill";
            } else {
                http_response_code(400);
                $response['status'] = "failed";
                $response['message'] = "gagal hapus skill";
            }
        } else {
            http_response_code(404);
            $response['status'] = 'failed';
            $response['message'] = 'gagal menghapus skill , skill tidak ditemukan ';
        }

        return $response;
    }

    public function findByPencariMagang(int $idPencariMagang): array
    {

        $skill = new Skill();
        $skill->setPencari_magang($idPencariMagang);
        $response = $this->repository->findByPencariMagang($skill);
        if ($response['status'] == 'ok') {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        return $response;
    }
}
