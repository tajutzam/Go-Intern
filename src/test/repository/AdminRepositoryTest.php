<?php

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Admin;
use LearnPhpMvc\repository\AdminRepository;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertNotNull;

class AdminRepositoryTest extends TestCase
{

    private AdminRepository $repository;


    function setUp(): void
    {
        $this->repository = new AdminRepository(Database::getConnection());
    }

    function testSave()
    {
        $admin = new Admin();
        $admin->setUsername("zam");
        $admin->setPassword("rahasia");
        $admin->setCreate_at("2022-10-10");
        $admin->setUpdate_at("2022-01-01");
        $admin->setNama("tajut");
        $response = $this->repository->save($admin);
        var_dump($response);
        assertNotNull($response);
    }

    function testFindByUsername()
    {
        $response = $this->repository->findByUsername("zam");
        var_dump($response);
        assertNotNull($response);
    }
    function testDate(){
        echo date("Y-m-d");
    }
}
