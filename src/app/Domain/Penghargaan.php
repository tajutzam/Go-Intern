<?php

namespace LearnPhpMvc\Domain;

class Penghargaan{

    private int $id_penghargaan;
    private string $judul;

    private string $file;

    private int $pencari_magang;
    


    /**
     * Get the value of id_penghargaan
     */ 
    public function getId_penghargaan()
    {
        return $this->id_penghargaan;
    }

    /**
     * Set the value of id_penghargaan
     *
     * @return  self
     */ 
    public function setId_penghargaan($id_penghargaan)
    {
        $this->id_penghargaan = $id_penghargaan;

        return $this;
    }

    /**
     * Get the value of judul
     */ 
    public function getJudul()
    {
        return $this->judul;
    }

    /**
     * Set the value of judul
     *
     * @return  self
     */ 
    public function setJudul($judul)
    {
        $this->judul = $judul;

        return $this;
    }

    /**
     * Get the value of file
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */ 
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get the value of pencari_magang
     */ 
    public function getPencari_magang()
    {
        return $this->pencari_magang;
    }

    /**
     * Set the value of pencari_magang
     *
     * @return  self
     */ 
    public function setPencari_magang($pencari_magang)
    {
        $this->pencari_magang = $pencari_magang;

        return $this;
    }
}