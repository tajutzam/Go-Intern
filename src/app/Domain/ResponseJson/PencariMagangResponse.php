<?php

namespace LearnPhpMvc\Domain\ResponseJson;

class PencariMagangResponse
{

    public array $body;
    public int $length;
    public PencariMagangDatumResponse $datum;

    /**
     * @param PencariMagangDatumResponse $datum
     */
    public function __construct()
    {
        $this->datum = new PencariMagangDatumResponse();
    }


}