<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Syarat;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;

class SyaratRepositoryTest extends TestCase
{

    public SyaratRepository $repository;

    
    function setUp(): void
    {
        $this->repository = new SyaratRepository(Database::getConnection());
    }
    

    function testSave(){
        $syarat = new Syarat();
        $syarat->setSyarat('Harus bisa mengoprasikan linux');
        $syarat->setId_magang(1);
        $responseSave =  $this->repository->save($syarat);
        assertNotNull($responseSave);
    }

    function testSaveNull(){
        $syarat = new Syarat();
        $syarat->setSyarat('Harus bisa mengoprasikan linux');
        $syarat->setId_magang(12213);
        $responseSave =  $this->repository->save($syarat);
        assertNull($responseSave);
    }

    function testUpdate(){
        $syarat = new Syarat();
        $syarat->setSyarat('upadted syarat test');
        $syarat->setId(37);
        $this->repository->updateSyarat($syarat);
    }

    function testFindByIdFailed(){
        $syarat = new Syarat();
        $syarat->setId(20);
        $result =  $this->repository->findById($syarat);
        assertNull($result);
    }
    function testFindByIdSuccess(){
        $syarat = new Syarat();
        $syarat->setId(37);
        $result =  $this->repository->findById($syarat);
        assertNotNull($result);
    }

    function testBySyarat(){
        $syarat = new Syarat();
        $syarat->setId_magang(37);
        $syarat->setSyarat('upadted syarat test');
        $response = $this->repository->findBySyarat($syarat);
        assertNotNull($response);
    }

    

}
