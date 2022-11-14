<?php

namespace LearnPhpMvc\Domain;

class Syarat
{

    private int $id;
    private string $syarat;
    private int $id_magang;
    
    

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
     * Get the value of syarat
     */ 
    public function getSyarat()
    {
        return $this->syarat;
    }

    /**
     * Set the value of syarat
     *
     * @return  self
     */ 
    public function setSyarat($syarat)
    {
        $this->syarat = $syarat;

        return $this;
    }

    /**
     * Get the value of id_magang
     */ 
    public function getId_magang()
    {
        return $this->id_magang;
    }

    /**
     * Set the value of id_magang
     *
     * @return  self
     */ 
    public function setId_magang($id_magang)
    {
        $this->id_magang = $id_magang;

        return $this;
    }
}