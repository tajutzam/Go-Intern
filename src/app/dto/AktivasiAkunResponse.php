<?php

namespace LearnPhpMvc\dto;

class AktivasiAkunResponse
{
    private string $expired;

    /**
     * @return string
     */
    public function getExpired(): string
    {
        return $this->expired;
    }

    /**
     * @param string $expired
     */
    public function setExpired(string $expired): void
    {
        $this->expired = $expired;
    }

}