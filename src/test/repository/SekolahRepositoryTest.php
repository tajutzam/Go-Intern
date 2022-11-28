<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Sekolah;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertNotNull;

class SekolahRepositoryTest extends TestCase
{
    public SekolahRepository $repository;

    protected function setUp() : void
    {
        $this->repository = new SekolahRepository(Database::getConnection());
    //  $this->repository->deleteAll();
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
        $sekolah->id = 24;
        $update = $this->repository->update($sekolah);
//      data update sesuai
        self::assertEquals($update->id, 24);
        self::assertEquals($update->sekolah , $sekolah->sekolah);
        self::assertEquals($update->jurusan, $sekolah->jurusan);
    }

    public function testUpdateFailed()
    {
        $sekolah = new Sekolah();
        $sekolah->sekolah = " Smkn baru 2";
        $sekolah->jurusan = "jurusan baru";
        $sekolah->id = 26;
        $update = $this->repository->update($sekolah);
        self::assertNull($update);
    }
    
    public function testDeleteByIdFailed()
    {
        $isDeleted = $this->repository->deleteById(123);
        self::assertFalse($isDeleted);
    }
    
    public function testFindBySekolah(){
        $sekolah = new Sekolah();
        $sekolah->sekolah = ' Smkn baru 2';
        $response = $this->repository->findBySekolah($sekolah);
        assertNotNull($response);
    }

}
