<?php

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Magang;
use LearnPhpMvc\repository\MagangRepository;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class MagangRepositoryTest extends TestCase
{

    private MagangRepository $repository;

    function setUp(): void
    {
        $this->repository = new MagangRepository(Database::getConnection());
    }

    function testSave()
    {
        $magang = new Magang();
        $magang->setPosisi_magang("backend");
        $magang->setPenyedia(41);
        $magang->setStatus('kosong');
        $magang->setLama_magang(6);
        $magang->setJumlah_maksimal(4);
        $responseSave =  $this->repository->addMagang($magang);
        assertNotNull($responseSave);
    }

    function testUpdate(){
     $magang = new Magang();
     $magang->setPosisi_magang("Backend engginer baru1");
     $magang->setKategori(2);
     $magang->setLama_magang(6);
     $magang->setJumlah_maksimal(2);
     $magang->setDeskripsi("deskripsi baru for backend engginer");
     $magang->setId(37);
     $result = $this->repository->updateMagang($magang);
     var_dump($result);
     assertNotNull($magang); 
    }

    function testShowOnMobile(){
       $responseData =  $this->repository->showMagangOnMobile();
       assertEquals("oke" , $responseData['status']);
    }
}
