<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\JenisUsaha;
use PHPUnit\Framework\TestCase;

class JenisUsahaRepositoryTest extends TestCase
{
    private JenisUsahaRepository $repository;

    protected function setUp() : void
    {
        $this->repository = new JenisUsahaRepository(Database::getConnection());
    }
    public function testFindAllSucess()
    {
        $all = $this->repository->findAll();
        var_dump($all);
        self::assertEquals("ok" , $all['status']);
    }
    public function testSaveSucces(){
        $usaha = new JenisUsaha();
        $usaha->setJenis("entertaiment");
        $save = $this->repository->save($usaha);
        self::assertNotNull($save);
        var_dump($save);
    }
    public function testfindByJenisLike(){
        $usaha = new JenisUsaha();
        $usaha->setJenis("e");
        $response  = $this->repository->findByJenisUsahaLike($usaha);
        self::assertEquals("ok" , $response['status']);
    }
    public function testfindByJenis(){
        $usaha = new JenisUsaha();
        $usaha->setJenis("pendidikan");
        $response  = $this->repository->findByJenisUsaha($usaha);
        self::assertNotNull($response);
    }
    public function testFindById()
    {
        $usaha = new JenisUsaha();
        $usaha->setId(1);
        $response  = $this->repository->findById($usaha);
        self::assertNotNull($response);
    }
    public function testFindByIdFailed()
    {
        $usaha = new JenisUsaha();
        $usaha->setId(110);
        $response  = $this->repository->findById($usaha);
        self::assertNull($response);
    }
    public function testUpdate()
    {
        $usaha = new JenisUsaha();
        $usaha->setId(1);
        $usaha->setJenis("pendidikan baru");
        $updated = $this->repository->update($usaha);
        self::assertNotNull($updated);
    }


}
