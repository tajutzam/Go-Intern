<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\Skill;
use PDO;

class SkillRepository
{

    protected PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    public function findBySkill(Skill $skill): ?Skill
    {
        $quert = <<<SQL
        select * from skill where skill = ? && pencari_magang = ?
SQL;
        $PDOStatement = $this->connection->prepare($quert);
        $PDOStatement->execute([$skill->getSkill(), $skill->getPencari_magang()]);
        if ($PDOStatement->rowCount() > 0) {
            while ($row = $PDOStatement->fetch(PDO::FETCH_ASSOC)) {
                $skill->setSkill($row['skill']);
                $skill->setPencari_magang($row['pencari_magang']);
                $skill->setId($row['id']);
            }
            return $skill;
        } else {
            return null;
        }
    }
    public function findAll(): array
    {
        $query = "select * from skill";
        $result = $this->connection->query($query);
        $response = array();
        $response['body'] = array();
        $response['length'] = 0;
        if ($result->rowCount() > 0) {
            $response['status'] = "ok";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    "id" => $row['id'],
                    "skill" => $row['skill'],
                    "pencari_magang" => $row['pencari_magang']
                );
                array_push($response['body'], $item);
            }
            $response['length'] = $result->rowCount();
            return $response;
        } else {
            $response['status'] = "data tidak ditemukan";
            return $response;
        }
    }

    public function findById($id): ?Skill
    {
        $skill = new Skill();
        $query = <<<SQL
        select  * from skill where id = ?
SQL;
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$id]);
        if ($PDOStatement->rowCount() > 0) {
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $skill->setPencari_magang($row['pencari_magang']);
            $skill->setSkill($row['skill']);
            $skill->setId($row['id']);
            return $skill;
        } else {
            return null;
        }
    }
    public function save(Skill $skill): Skill
    {
        $query = <<<SQL
        insert into skill (skill , pencari_magang) values (? , ?)
SQL;
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$skill->getSkill(), $skill->getPencari_magang()]);
        $skill->setId($this->connection->lastInsertId());
        return $skill;
    }
    public function update(Skill $skill): ?Skill
    {
        $query = <<<SQL
        update skill set skill = ?  where id = ?
SQL;
        try {
            $this->connection->beginTransaction();
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$skill->getSkill(), $skill->getId()]);
            $this->connection->commit();
            return $skill;
        } catch (\PDOException $exception) {
            $this->connection->rollBack();


            return null;
        }
    }
    public function deletebyId(Skill $skill): bool
    {
        try {
            $byId = $this->findById($skill->getId());
            if ($byId == null) {
                return false;
            } else {
                $query = <<<SQL
        DELETE  from skill where id = ? and pencari_magang = ?
SQL;
                $PDOStatement = $this->connection->prepare($query);
                $PDOStatement->execute([$skill->getId(), $byId->getPencari_magang()]);
                return true;
            } {
            }
        } catch (\PDOException $exception) {


            return false;
        }
    }

    public function findByPencariMagang(Skill $skill) : array{
        $query = "select * from skill where pencari_magang = ?";
        $result = $this->connection->prepare($query);
        $result->execute([$skill->getPencari_magang()]);
       
        $response = array();
        $response['skills'] = array();
        if($result->rowCount() > 0 ){
            $response['status'] = "ok";
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $items = array(
                    "id" => $row['id'] , 
                    "skill" => $row['skill'],
                    "pencari_magang" => $row['pencari_magang']
                );

                array_push($response['skills'] , $items);
            }
        }else{
            $response['status'] = 'failed';
        }
        return $response;
    }
}
