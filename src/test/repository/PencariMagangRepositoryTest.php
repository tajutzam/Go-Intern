<?php

namespace LearnPhpMvc\repository;

use Cassandra\Date;
use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\Sekolah;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class PencariMagangRepositoryTest extends TestCase
{
    public PencariMagangRepository $repository;
    public SekolahRepository $sekolahRepository;
    protected function setUp(): void
    {
        $this->repository = new PencariMagangRepository(Database::getConnection());
        $this->sekolahRepository = new SekolahRepository(Database::getConnection());
        //$this->repository->deleteAll();
    }
    public function testFindAll()
    {
        $all = $this->repository->findAll();
        self::assertEquals(200, http_response_code()); // data found
        self::assertNotNull($all);
        self::assertEquals("oke", $all['status']);
    }
    public function testFindAllNull()
    {
        $all = $this->repository->findAll();
        self::assertEquals(404, http_response_code());
        self::assertEquals("data tidak ditemukan", $all['status']);
    }
    public function testSave()
    {
        $sekolah = new Sekolah();
        $pencariMagang = new PencariMagang($sekolah);
        $sekolah = $this->sekolahRepository->findById(24);
        $dt = new \DateTime();
        $date = \date("Y-m-d");
        $pencariMagang->setUsername("zam baru");
        $pencariMagang->setPassword("zam baru");
        $pencariMagang->setEmail("zam");
        $pencariMagang->setNo_telp("0821323123");
        $pencariMagang->setAgama("islam");
        $pencariMagang->setTanggalLahir($date);
        $pencariMagang->setToken("asdasdasd");
        $pencariMagang->setCv("Adasdas");
        $pencariMagang->setResume("Adadas");
        $pencariMagang->setStatus("aktif");
        $pencariMagang->setStatusMagang("tidak_magang");
        $pencariMagang->setRole(3);
        $pencariMagang->setFoto("imgae.jpg");
        $pencariMagang->setNama('zam');
        $magang = $this->repository->save($pencariMagang, $sekolah);
        self::assertNotNull($magang);
        self::assertEquals($pencariMagang->getUsername(), $magang->getUsername());
        self::assertEquals($pencariMagang->getRole(), $magang->getRole());
    }

    public function testFindById()
    {
        $pencariMagang = $this->repository->findById(17);
        self::assertNotNull($pencariMagang);
        self::assertEquals(17, $pencariMagang->getId());
    }
    public function testFindByIdFailed()
    {
        $pencariMagang = $this->repository->findById(9);
        self::assertNull($pencariMagang);
    }

    public function testUpdate()
    {
        $sekolah = new Sekolah();
        $sekolah->id = 24;
        $pencariMagang = new PencariMagang($sekolah);
        $pencariMagang->setUsername("zam baru update");
        $pencariMagang->setPassword("password baru");
        $pencariMagang->setEmail("mohammad bar");
        $pencariMagang->setRole(3);
        $pencariMagang->setId(15);
        $pencariMagang->setIdSekolah(24);
        $pencariMagang->setStatus("aktif");
        $pencariMagang->setAgama("islam");
        $pencariMagang->setNo_telp("0123123");
        $pencariMagang->setToken("sadasdasds");
        $pencariMagang->setCv("asdasd");
        $pencariMagang->setResume("asdasd");
        $pencariMagang->setStatusMagang("tidak_magang");
        $pencariMagang->setFoto("aweaweaw.jpg");
        $date = \date("Y-m-d");
        $timestamp = new \DateTime();
        $pencariMagang->setTanggalLahir($date);
        $updated = $this->repository->update($pencariMagang);
        var_dump($updated);
        self::assertNotNull($updated);
        self::assertEquals($pencariMagang->getUsername(), $updated->getUsername());
        self::assertEquals($pencariMagang->getEmail(), $updated->getEmail());
        self::assertEquals($pencariMagang->getPassword(), $updated->getPassword());
        self::assertEquals($pencariMagang->getTanggalLahir(), $updated->getTanggalLahir());
        self::assertEquals($pencariMagang->getToken(), $updated->getToken());
        self::assertEquals($pencariMagang->getStatus(), $updated->getStatus());
        self::assertEquals($pencariMagang->getRole(), $updated->getRole());
        self::assertEquals($pencariMagang->getCv(), $updated->getCv());
    }
    public function testUpdateFailed()
    {
        $sekolah = new Sekolah();
        $sekolah->id = 24; // data not found
        $pencariMagang = new PencariMagang();
        $pencariMagang->setId(17);
        $pencariMagang->setUsername("zam baru update");
        $pencariMagang->setPassword("password baru");
        $pencariMagang->setEmail("mohammad bar");
        $pencariMagang->setRole(3);
        $pencariMagang->setId(13);
        $pencariMagang->setStatus("aktif");
        $pencariMagang->setAgama("islam");
        $pencariMagang->setNo_telp("0123123");
        $pencariMagang->setToken("sadasdasds");
        $pencariMagang->setCv("asdasd");
        $pencariMagang->setResume("asdasd");
        $pencariMagang->setFoto("asdasd/jpd");
        $pencariMagang->setStatusMagang("tidak_magang");
        $date = \date("Y-m-d");
        $timestamp = new \DateTime();
        $pencariMagang->setTanggalLahir($date);
        $updated = $this->repository->update($pencariMagang);
        self::assertNull($updated);
    }
    public function testDeleteById()
    {
        $deleteById = $this->repository->deleteById(15);
        self::assertTrue($deleteById);
    }
    public function testDeleteByIdFailed()
    {
        $deleteById = $this->repository->deleteById(123);
        self::assertFalse($deleteById);
    }

    public function testFindByUsername()
    {
        $byUsername = $this->repository->findByUsername('zam baru');
        self::assertNotNull($byUsername);
        var_dump($byUsername);
        echo count($byUsername['body']);
        self::assertEquals("oke", $byUsername['status']);
    }
    public function testFindByUsernamefailed()
    {
        $byUsername = $this->repository->findByUsername('barasu');
        self::assertNotNull($byUsername);
        var_dump($byUsername);
        self::assertEquals("data tidak ditemukan", $byUsername['status']);
    }
    public function testUpdateDeskripsiSekolah()
    {
        $pencariMagang = new PencariMagang();
        $pencariMagang->setDeskripsi_sekolah('deskripsi sekolah saya');
        $pencariMagang->setId(103);

        $response =  $this->repository->updateDeskripsiSekolah($pencariMagang);
        assertNotNull($response);
    }

    public function testShowDataSekolaByPencariSucces()
    {
        $pencarimagang = new PencariMagang();
        $pencarimagang->setId(103);
        $response = $this->repository->findBySekolah($pencarimagang);
        assertEquals('oke', $response['status']);
        var_dump($response);
    }
    public function testShowDataSekolaByPencariFailed()
    {
        $pencarimagang = new PencariMagang();
        $pencarimagang->setId(104);
        $response = $this->repository->findBySekolah($pencarimagang);
        assertEquals('failed', $response['status']);
        var_dump($response);
    }

    public function testUpdatedatapersonal()
    {
        $pencariMagang = new PencariMagang();
        $pencariMagang->setNama('jemi');
        $pencariMagang->setEmail('mohammadtajutzamzami07@gmail.com');
        $pencariMagang->setTanggalLahir("2022-11-30");
        $pencariMagang->setAgama('islam');
        $pencariMagang->setJenis_kelamin('L');
        $pencariMagang->setId(142);
        $response =  $this->repository->updateDataPersonal($pencariMagang);
        assertNotNull($response);
        var_dump($response);
    }
}
