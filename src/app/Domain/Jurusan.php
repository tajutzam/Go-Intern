<?php


namespace LearnPhpMvc\Domain;

class Jurusan{
    
    private int $id;

    private string $jurusan;
    
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of jurusan
     */ 
    public function getJurusan()
    {
        return $this->jurusan;
    }

    /**
     * Set the value of jurusan
     *
     * @return  self
     */ 
    public function setJurusan($jurusan)
    {
        $this->jurusan = $jurusan;

        return $this;
    }
}