<?php

namespace LearnPhpMvc\Domain;

class JenisUsaha
{

    private int $id;
    private string $jenis;

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
    public function getJenis(): string
    {
        return $this->jenis;
    }

    /**
     * @param string $jenis
     */
    public function setJenis(string $jenis): void
    {
        $this->jenis = $jenis;
    }


}