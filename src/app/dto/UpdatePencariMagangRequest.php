<?php


namespace LearnPhpMvc\dto;

class UpdatePencariMagangRequest{
    
    private int $id;
    private string $username;
    private string $password;
    private string $email;
    private string $no_telp;
    private string $tanggalLahir;
    private int $id_sekolah;
    private string $foto;
    private string $nama;
    private string $agama;
    private string $resume;
    private string $cv;

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
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of no_telp
     */ 
    public function getNo_telp()
    {
        return $this->no_telp;
    }

    /**
     * Set the value of no_telp
     *
     * @return  self
     */ 
    public function setNo_telp($no_telp)
    {
        $this->no_telp = $no_telp;

        return $this;
    }

    /**
     * Get the value of tanggalLahir
     */ 
    public function getTanggalLahir()
    {
        return $this->tanggalLahir;
    }

    /**
     * Set the value of tanggalLahir
     *
     * @return  self
     */ 
    public function setTanggalLahir($tanggalLahir)
    {
        $this->tanggalLahir = $tanggalLahir;

        return $this;
    }

    /**
     * Get the value of id_sekolah
     */ 
    public function getId_sekolah()
    {
        return $this->id_sekolah;
    }

    /**
     * Set the value of id_sekolah
     *
     * @return  self
     */ 
    public function setId_sekolah($id_sekolah)
    {
        $this->id_sekolah = $id_sekolah;

        return $this;
    }

    /**
     * Get the value of foto
     */ 
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     *
     * @return  self
     */ 
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get the value of nama
     */ 
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * Set the value of nama
     *
     * @return  self
     */ 
    public function setNama($nama)
    {
        $this->nama = $nama;

        return $this;
    }

    /**
     * Get the value of agama
     */ 
    public function getAgama()
    {
        return $this->agama;
    }

    /**
     * Set the value of agama
     *
     * @return  self
     */ 
    public function setAgama($agama)
    {
        $this->agama = $agama;

        return $this;
    }

    /**
     * Get the value of cv
     */ 
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set the value of cv
     *
     * @return  self
     */ 
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get the value of resume
     */ 
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set the value of resume
     *
     * @return  self
     */ 
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }
}