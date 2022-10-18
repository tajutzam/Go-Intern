<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Config\Database;
use PHPUnit\Framework\TestCase;

class PencariMagangRepositoryTest extends TestCase
{

    public PencariMagangRepository $repository;

    protected function setUp() :void
    {
        $this->repository= new PencariMagangRepository(Database::getConnection());
        $this->repository->deleteAll();
    }

    public function testFindAll()
    {
        $all = $this->repository->findAll();
//        data tidak ada
        self::assertEquals(200 , http_response_code()); // data found
        self::assertNotNull($all);
    }

    public function testFindAllNull()
    {
        $all = $this->repository->findAll();
        self::assertEquals(404 , http_response_code()); // data not found
    }


}
