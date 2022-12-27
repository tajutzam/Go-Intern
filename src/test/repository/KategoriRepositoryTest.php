<?php

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Kategori;
use LearnPhpMvc\repository\KategoriRepository;
use PHPUnit\Framework\TestCase;



class KategoriRepositoryTest extends TestCase
{

    private KategoriRepository $repository;


    function setUp(): void
    {
        $this->repository = new KategoriRepository(Database::getConnection());
    }

    function testAddKategori()
    {
        $kategori = new Kategori();
        $kategori->setFoto("asdasd");
        $kategori->setKategori("asdsad");
        $response = $this->repository->addKategori($kategori);
        var_dump($response);
    }
}
