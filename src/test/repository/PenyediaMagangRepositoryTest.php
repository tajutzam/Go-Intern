<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\PenyediaMagang;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;

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
    
    // $penyediaMagang->getNamaPerushaan(),
    // $penyediaMagang->getEmail(),
    // $penyediaMagang->getNoTelp(),
    // $penyediaMagang->getPassword(),
    // $penyediaMagang->getUsername(),
    // $penyediaMagang->getToken(),
    // $penyediaMagang->getRole(),
    // $penyediaMagang->getStatus(),

    public function testSaveSucces()
    {
        $penyediaMagang = new PenyediaMagang();

        $penyediaMagang->setNamaPerushaan("Polije bondowosos");
                $penyediaMagang->setAlamaPerushaan("jl. mastrip");
                $penyediaMagang->setEmail("polije@gmaislw.com");
                $penyediaMagang->setNoTelp("123123123");
                $penyediaMagang->setPassword("rahasia");
                $penyediaMagang->setUsername("baru");
                $penyediaMagang->setToken("");
                $penyediaMagang->setRole(5);
                $penyediaMagang->setJenisUsaha(1);
                $penyediaMagang->setStatus("aktif");
                $penyediaMagang->setLokasi(1);
                $penyediaMagang->setFoto("");
        $saved = $this->repository->save($penyediaMagang);
        var_dump($saved);
        self::assertNotNull($saved);
    }
    public function testFindById()
    {

    }
    public function testFindByUsername()
    {
        $penyedia_magang = new PenyediaMagang();
        $penyedia_magang->setUsername("username");
        $magang = $this->repository->findByUsername($penyedia_magang);
        var_dump($magang);
    }

    public function testUpdate(){
        $penyedia = new PenyediaMagang();
        $penyedia->setNamaPerushaan("baru");
        $penyedia->setAlamaPerushaan("jalan polije , jember ");
        $penyedia->setEmail("mohammadtajutzamzami07@gmail.com");
        $penyedia->setNoTelp("07123123131");
        $penyedia->setUsername("Zam");
        $penyedia->setJenisUsaha(1);
        $penyedia->setFoto("adasdasdsadsad");
        $penyedia->setId(39);
        $updated = $this->repository->updateData($penyedia);
        assertNotNull($updated);
    }

    public function testUpdateFailed(){
        $penyedia = new PenyediaMagang();
        $penyedia->setNamaPerushaan("baru");
        $penyedia->setAlamaPerushaan("jalan polije , jember ");
        $penyedia->setEmail("mohammadtajutzamzami07@gmail.com");
        $penyedia->setNoTelp("07123123131");
        $penyedia->setUsername("Zam");
        $penyedia->setJenisUsaha(1);
        $penyedia->setFoto("adasdasdsadsad"); 
        $updated = $this->repository->updateData($penyedia);
        assertNull($updated);
    }
    
}
