<?php

namespace LearnPhpMvc\Domain;

class Otp{

    private int $id;

    private int $otp;

    private int $pencari_magang;
    

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
     * Get the value of otp
     */ 
    public function getOtp()
    {
        return $this->otp;
    }

    /**
     * Set the value of otp
     *
     * @return  self
     */ 
    public function setOtp($otp)
    {
        $this->otp = $otp;

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