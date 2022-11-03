<?php

namespace LearnPhpMvc\dto;

class RegisterPencariMagangRequest
{
    private string $username;
    private string $email;
    private string $nama_depan;
    private  string $nama_belakang;
    private string $password;
    private string $resume;
    private string $cv;
    private string $skill;
    private string $alamat;
    private int $id_sekolah;
    private int $role;
    private string $notelp;
    private string $agama;
    private string $token;
    private string $foto;
    private string $tanggal_lahir;

    /**
     * @return string
     */
    public function getTanggalLahir(): string
    {
        return $this->tanggal_lahir;
    }

    /**
     * @param string $tanggal_lahir
     */
    public function setTanggalLahir(string $tanggal_lahir): void
    {
        $this->tanggal_lahir = $tanggal_lahir;
    }



    /**
     * @return string
     */
    public function getFoto(): string
    {
        return $this->foto;
    }

    /**
     * @param string $foto
     */
    public function setFoto(string $foto): void
    {
        $this->foto = $foto;
    }



    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }


    /**
     * @return string
     */
    public function getAgama(): string
    {
        return $this->agama;
    }

    /**
     * @param string $agama
     */
    public function setAgama(string $agama): void
    {
        $this->agama = $agama;
    }



    /**
     * @return string
     */
    public function getNotelp(): string
    {
        return $this->notelp;
    }

    /**
     * @param string $notelp
     */
    public function setNotelp(string $notelp): void
    {
        $this->notelp = $notelp;
    }




    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param int $role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }


    /**
     * @return int
     */
    public function getIdSekolah(): int
    {
        return $this->id_sekolah;
    }

    /**
     * @param int $id_sekolah
     */
    public function setIdSekolah(int $id_sekolah): void
    {
        $this->id_sekolah = $id_sekolah;
    }



    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getNamaDepan(): string
    {
        return $this->nama_depan;
    }

    /**
     * @param string $nama_depan
     */
    public function setNamaDepan(string $nama_depan): void
    {
        $this->nama_depan = $nama_depan;
    }

    /**
     * @return string
     */
    public function getNamaBelakang(): string
    {
        return $this->nama_belakang;
    }

    /**
     * @param string $nama_belakang
     */
    public function setNamaBelakang(string $nama_belakang): void
    {
        $this->nama_belakang = $nama_belakang;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getResume(): string
    {
        return $this->resume;
    }

    /**
     * @param string $resume
     */
    public function setResume(string $resume): void
    {
        $this->resume = $resume;
    }

    /**
     * @return string
     */
    public function getCv(): string
    {
        return $this->cv;
    }

    /**
     * @param string $cv
     */
    public function setCv(string $cv): void
    {
        $this->cv = $cv;
    }

    /**
     * @return string
     */
    public function getSkill(): string
    {
        return $this->skill;
    }

    /**
     * @param string $skill
     */
    public function setSkill(string $skill): void
    {
        $this->skill = $skill;
    }

    /**
     * @return string
     */
    public function getAlamat(): string
    {
        return $this->alamat;
    }

    /**
     * @param string $alamat
     */
    public function setAlamat(string $alamat): void
    {
        $this->alamat = $alamat;
    }


}