<?php



namespace LearnPhpMvc\Domain;

class Kategori{


    private int $id;

    private string $kategori;



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
     * Get the value of kategori
     */ 
    public function getKategori()
    {
        return $this->kategori;
    }

    /**
     * Set the value of kategori
     *
     * @return  self
     */ 
    public function setKategori($kategori)
    {
        $this->kategori = $kategori;

        return $this;
    }
}