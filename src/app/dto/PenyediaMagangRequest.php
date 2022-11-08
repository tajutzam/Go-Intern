<?php

namespace LearnPhpMvc\dto;

class PenyediaMagangRequest
{

    private int $id;
    private string $username;
    private string $password;
    private string $email;
    private string $nama_perushaan;
    private string $alamat_perushaan;
    private string $no_telp;
    private string $status;
    private int $lokasi ;
    private int $jenis_usaha;
    private string $foto;
    private string $token;
    private int $role;
    private string $create_at;
    private string $update_at;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
    public function getNamaPerushaan(): string
    {
        return $this->nama_perushaan;
    }

    /**
     * @param string $nama_perushaan
     */
    public function setNamaPerushaan(string $nama_perushaan): void
    {
        $this->nama_perushaan = $nama_perushaan;
    }

    /**
     * @return string
     */
    public function getAlamatPerushaan(): string
    {
        return $this->alamat_perushaan;
    }

    /**
     * @param string $alamat_perushaan
     */
    public function setAlamatPerushaan(string $alamat_perushaan): void
    {
        $this->alamat_perushaan = $alamat_perushaan;
    }

    /**
     * @return string
     */
    public function getNoTelp(): string
    {
        return $this->no_telp;
    }

    /**
     * @param string $no_telp
     */
    public function setNoTelp(string $no_telp): void
    {
        $this->no_telp = $no_telp;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getLokasi(): int
    {
        return $this->lokasi;
    }

    /**
     * @param int $lokasi
     */
    public function setLokasi(int $lokasi): void
    {
        $this->lokasi = $lokasi;
    }

    /**
     * @return int
     */
    public function getJenisUsaha(): int
    {
        return $this->jenis_usaha;
    }

    /**
     * @param int $jenis_usaha
     */
    public function setJenisUsaha(int $jenis_usaha): void
    {
        $this->jenis_usaha = $jenis_usaha;
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
     * @return string
     */
    public function getCreateAt(): string
    {
        return $this->create_at;
    }

    /**
     * @param string $create_at
     */
    public function setCreateAt(string $create_at): void
    {
        $this->create_at = $create_at;
    }

    /**
     * @return string
     */
    public function getUpdateAt(): string
    {
        return $this->update_at;
    }

    /**
     * @param string $update_at
     */
    public function setUpdateAt(string $update_at): void
    {
        $this->update_at = $update_at;
    }



}