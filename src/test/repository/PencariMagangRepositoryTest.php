<?php

namespace LearnPhpMvc\repository;

use Cassandra\Date;
use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\Sekolah;
use PHPUnit\Framework\TestCase;

class PencariMagangRepositoryTest extends TestCase
{
    public PencariMagangRepository $repository;
    public SekolahRepository $sekolahRepository;
    protected function setUp() :void
    {
        $this->repository= new PencariMagangRepository(Database::getConnection());
        $this->sekolahRepository = new SekolahRepository(Database::getConnection());
        $this->repository->deleteAll();
    }
    public function testFindAll()
    {
        $all = $this->repository->findAll();
        self::assertEquals(200 , http_response_code()); // data found
        self::assertNotNull($all);
        self::assertEquals("oke" , $all['status']);
    }

    public function testFindAllNull()
    {
        $all = $this->repository->findAll();
        self::assertEquals(404 , http_response_code());
        self::assertEquals("data tidak ditemukan" , $all['status']);
    }

    public function testSave()
    {
        $pencariMagang = new PencariMagang();
        $sekolah = $this->sekolahRepository->findById(24);
        $dt = new \DateTime();
        $date = \date("Y-m-d");
                    $pencariMagang->setUsername("zam baru");
                    $pencariMagang->setPassword("zam baru");
                    $pencariMagang -> setEmail("zam");
                    $sekolah->id;
                    $pencariMagang->setNo_telp("0821323123");
                    $pencariMagang ->setAgama("islam");
                    $pencariMagang -> setTanggalLahir($date);
                    $pencariMagang->setToken("asdasdasd");
                    $pencariMagang -> setCv("Adasdas");
                    $pencariMagang -> setResume("Adadas");
                    $pencariMagang -> setStatus("aktif");
                    $pencariMagang -> setStatusMagang("tidak-magang");
                    $pencariMagang -> setRole(3);
        $magang = $this->repository->save($pencariMagang , $sekolah);
        self::assertNotNull($magang);
    }

    public function testFindById()
    {
        $pencariMagang = $this->repository->findById(12);
        self::assertNotNull($pencariMagang);
        self::assertEquals(9 , $pencariMagang->getId());
    }
    public function testFindByIdFailed()
    {
        $pencariMagang = $this->repository->findById(9);
       self::assertNull($pencariMagang);
    }
}
