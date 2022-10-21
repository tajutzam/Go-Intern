<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\PenyediaMagang;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class PenyediaMagangRepositoryTest extends TestCase
{
    public PenyediaMagangRepository $repository;

    protected function setUp() :void
    {
        $this->repository = new PenyediaMagangRepository(Database::getConnection());
    }
    public function testFindAllNull()
    {
        $arr = $this->repository->findAll();
        // data must be null
        self::assertEquals("data tidak ada" , $arr['status']);
    }
    public function testFindAllSuccess()
    {
        $all = $this->repository->findAll();
        assertEquals("oke", $all['status']);
    }

    public function testSaveSucces()
    {
        $penyediaMagang = new PenyediaMagang();

        $penyediaMagang->setNamaPerushaan("Polije bondowoso");
                $penyediaMagang->setAlamaPerushaan("jl. mastrip");
                $penyediaMagang->setEmail("polije@gmail.com");
                $penyediaMagang->setNoTelp("123123123");
                $penyediaMagang->setPassword("rahasia");
                $penyediaMagang->setUsername("username");
                $penyediaMagang->setToken("ASDasd");
                $penyediaMagang->setRole(3);
                $penyediaMagang->setJenisUsaha(1);
                $penyediaMagang->setStatus("aktif");
                $penyediaMagang->setLokasi(1);
                $penyediaMagang->setFoto("foto");
        $saved = $this->repository->save($penyediaMagang);
        var_dump($saved);
        self::assertNotNull($saved);
    }

    public function testFindById()
    {

    }


}
