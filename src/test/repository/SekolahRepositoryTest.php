<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Sekolah;
use PHPUnit\Framework\TestCase;

class SekolahRepositoryTest extends TestCase
{
    public SekolahRepository $repository;

    protected function setUp() : void
    {
        $this->repository = new SekolahRepository(Database::getConnection());
      $this->repository->deleteAll();
    }

    public function testFindAll()
    {
        $sekolah = new Sekolah();
        $sekolah->sekolah = "Smkn 1 Tegalsari";
        $sekolah->jurusan = "Teknik Komputer dan jaringan";
        $this->repository->save($sekolah);
        $all =$this->repository->findAll();
        self::assertEquals(200 , http_response_code());
        $this->assertEquals("Smkn 1 Tegalsari" , $all['data'][0]['nama_sekolah']);
    }

    public function testFindById()
    {
//      success karena data semua di delete
        $sekolah = $this->repository->findById(4);
        self::assertNotNull($sekolah);
    }


    public function testFindByIdFailed()
    {
        $sekolah = $this->repository->findById(12);
        self::assertNull($sekolah);
    }

    public function testSave()
    {
        $sekolah = new Sekolah();
        $sekolah->sekolah = "Smkn 2 Tegalsari ";
        $sekolah->jurusan = "Komputer jaringan";
        $save = $this->repository->save($sekolah);
        self::assertNotNull($save);

    }

    public function testUpdate()
    {
        $sekolah = new Sekolah();
        $sekolah->sekolah = " Smkn baru 2";
        $sekolah->jurusan = "jurusan baru";
        $sekolah->id = 23;
        $update = $this->repository->update($sekolah);
//      data update sesuai
        self::assertEquals($update->id , 23);
        self::assertEquals($update->sekolah , $sekolah->sekolah);
        self::assertEquals($update->jurusan, $sekolah->jurusan);
    }


}
