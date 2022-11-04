<?php

namespace LearnPhpMvc\dto;

class AktivasiAkunRequest
{

    private string $token;
    private string $email;
    private string $username;
    private string $exparedAkun;

    /**
     * @return string
     */
    public function getExparedAkun(): string
    {
        return $this->exparedAkun;
    }

    /**
     * @param string $exparedAkun
     */
    public function setExparedAkun(string $exparedAkun): void
    {
        $this->exparedAkun = $exparedAkun;
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



}