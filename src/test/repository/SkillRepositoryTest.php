<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Skill;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class SkillRepositoryTest extends TestCase
{
    private SkillRepository $repository;
    protected function setUp(): void
    {
        $this->repository = new SkillRepository(Database::getConnection());
    }

    public function testSave()
    {
        $skill = new Skill();
        $skill->setSkill("Backend developer");
        $skill->setPencari_magang(19);
        $save = $this->repository->save($skill);
        var_dump($save);
    }

    public function testFindBySkillSuccess()
    {
        $skill = new Skill();
        $skill->setSkill("Backend developer");
        $skill->setPencari_magang(19);
        $bySkill = $this->repository->findBySkill($skill);
        var_dump($bySkill);
        self::assertNotNull($bySkill);
        self::assertEquals("Backend developer", $bySkill->getSkill());
    }

    public function testFindBySkillNull()
    {
        $skill = new Skill();
        $skill->setSkill("asdasd");
        $skill->setPencari_magang(19);
        $bySkill = $this->repository->findBySkill($skill);
        self::assertNull($bySkill);
    }

    public function testFindById()
    {
        $byId = $this->repository->findById(1);
        self::assertNotNull($byId);
    }

    public function testUpdate()
    {
        $skill = new Skill();
        $skill->setSkill("Backend developer baru");
        $skill->setId(1);
        $update = $this->repository->update($skill);
        var_dump($update);
        self::assertNotNull($update);
    }
    public function testDeleteSuccess()
    {
        $skill = new Skill();
        $skill->setId(2);

        $deletebyId = $this->repository->deletebyId($skill);
        self::assertTrue($deletebyId);
    }
    public function testDeleteFailed()
    {
        $skill = new Skill();
        $skill->setId(3);
        $deleteId = $this->repository->deletebyId($skill);
        var_dump($deleteId);
        self::assertFalse($deleteId);
    }
    public function testFIndByPencariMagang()
    {
        $skill = new Skill();
        $skill->setPencari_magang(103);
        $response =   $this->repository->findByPencariMagang($skill);
        assertEquals('ok' , $response['status']);
    }
}
