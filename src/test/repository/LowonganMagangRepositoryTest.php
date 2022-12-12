<?php

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\LowonganMagang;
use LearnPhpMvc\repository\LowonganMagangRepository;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertNotNull;

class LowonganMagangRepositoryTest extends TestCase
{


    private LowonganMagangRepository $repository;

    public function setUp(): void
    {
        $this->repository = new LowonganMagangRepository(Database::getConnection());
    }

    public function testAddLowonganMagang()
    {
        $lowongan = new LowonganMagang();
        $lowongan->setId_magang(113);
        $lowongan->setId_penyediaMagang(91);
        $lowongan->setId_pencariMagang(141);
        $response = $this->repository->addLowonganMagang($lowongan);
        var_dump($response);
        assertNotNull($response);
    }
}
