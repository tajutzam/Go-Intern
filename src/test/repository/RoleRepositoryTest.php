<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Role;
use LearnPhpMvc\Exeptions\ValidationExeptions;
use PHPUnit\Framework\TestCase;

class RoleRepositoryTest extends TestCase
{
    public RoleRepository $repository;
    protected function setUp() : void
    {
        $this-> repository = new RoleRepository(Database::getConnection());
    }

    public function testSave()
    {
        $role = new Role();
        $role->setRole('magang');
        $save = $this->repository->save($role);
        self::assertNotNull($save);

    }
    public function testFindByIdSuccess()
    {
        $byId = $this->repository->findById(4);
        var_dump($byId);
        self::assertNotNull($byId);
    }

    public function testFindByIdNotFailed()
    {
        $role = $this->repository->findById(5);
        self::assertNull($role);
    }
    public function testFindAll()
    {
        $role = $this->repository->findAll();
        var_dump($role);
        self::assertNotNull($role);
    }

    public function testFindAllNull()
    {
        $role = $this->repository->findAll();
//        data harus null agar success
        self::assertNull($role);
    }


    public function testUpdateSucces()
    {
        $role = new Role();
        $role->setId(3);
        $role->setRole("admin new");
        $result = $this->repository->update($role);
        var_dump($result);
        self::assertNotNull($result);
    }

    public function testUpdateNotSuccess()
    {
        $result = $this->repository->update("admin salah", 10);
        var_dump($result);
        $this->expectOutputRegex("[data tidak ditemukan]");
    }

}
