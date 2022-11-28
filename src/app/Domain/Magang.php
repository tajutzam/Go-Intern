<?php


namespace LearnPhpMvc\Domain;

class Magang{

    private int $id;
    private string $posisi_magang;
    private string $status;
    private int $lama_magang;
    private int $jumlah_maksimal;
    private int $jumlah_saatini;

    private int $penyedia;
    
    private string $deskripsi;

    private int $kategori;

    private int $salary; 


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
     * Get the value of posisi_magang
     */ 
    public function getPosisi_magang()
    {
        return $this->posisi_magang;
    }

    /**
     * Set the value of posisi_magang
     *
     * @return  self
     */ 
    public function setPosisi_magang($posisi_magang)
    {
        $this->posisi_magang = $posisi_magang;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of lama_magang
     */ 
    public function getLama_magang()
    {
        return $this->lama_magang;
    }

    /**
     * Set the value of lama_magang
     *
     * @return  self
     */ 
    public function setLama_magang($lama_magang)
    {
        $this->lama_magang = $lama_magang;

        return $this;
    }

    /**
     * Get the value of jumlah_maksimal
     */ 
    public function getJumlah_maksimal()
    {
        return $this->jumlah_maksimal;
    }

    /**
     * Set the value of jumlah_maksimal
     *
     * @return  self
     */ 
    public function setJumlah_maksimal($jumlah_maksimal)
    {
        $this->jumlah_maksimal = $jumlah_maksimal;

        return $this;
    }

    /**
     * Get the value of jumlah_saatini
     */ 
    public function getJumlah_saatini()
    {
        return $this->jumlah_saatini;
    }

    /**
     * Set the value of jumlah_saatini
     *
     * @return  self
     */ 
    public function setJumlah_saatini($jumlah_saatini)
    {
        $this->jumlah_saatini = $jumlah_saatini;

        return $this;
    }

    /**
     * Get the value of penyedia
     */ 
    public function getPenyedia()
    {
        return $this->penyedia;
    }

    /**
     * Set the value of penyedia
     *
     * @return  self
     */ 
    public function setPenyedia($penyedia)
    {
        $this->penyedia = $penyedia;

        return $this;
    }

    /**
     * Get the value of deskripsi
     */ 
    public function getDeskripsi()
    {
        return $this->deskripsi;
    }

    /**
     * Set the value of deskripsi
     *
     * @return  self
     */ 
    public function setDeskripsi($deskripsi)
    {
        $this->deskripsi = $deskripsi;

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

    /**
     * Get the value of salary
     */ 
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set the value of salary
     *
     * @return  self
     */ 
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }
}