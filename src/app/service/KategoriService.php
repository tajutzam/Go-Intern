<?php



namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\repository\KategoriRepository;

class KategoriService{

    private KategoriRepository $repository;

    
    public function __construct()
    {
        $this->repository = new KategoriRepository(Database::getConnection());
    }

    public function findAll() : array{
        return $this->repository->findAll();
    }

}