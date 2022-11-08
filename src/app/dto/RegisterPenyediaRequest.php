<?php

namespace LearnPhpMvc\dto;

class RegisterPenyediaRequest
{

    private string $username;
    private string $password;

    private string $email;
    private string $nama_perusahaan;

    private string $no_telp;

    private int $role;

    private int $jenis_usaha;

    private string $token;

    


    

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
     * Get the value of nama_perusahaan
     */ 
    public function getNama_perusahaan()
    {
        return $this->nama_perusahaan;
    }

    /**
     * Set the value of nama_perusahaan
     *
     * @return  self
     */ 
    public function setNama_perusahaan($nama_perusahaan)
    {
        $this->nama_perusahaan = $nama_perusahaan;

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
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
    /**
     * Get the value of jenis_usaha
     */ 
    public function getJenis_usaha()
    {
        return $this->jenis_usaha;
    }

    /**
     * Set the value of jenis_usaha
     *
     * @return  self
     */ 
    public function setJenis_usaha($jenis_usaha)
    {
        $this->jenis_usaha = $jenis_usaha;

        return $this;
    }

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}