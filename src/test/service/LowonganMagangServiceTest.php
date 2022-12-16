<?php

use LearnPhpMvc\service\LowonganMagangService;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class LowonganMagangServiceTest extends TestCase
{

    private LowonganMagangService $service;


    function setUp(): void
    {
        $this->service = new LowonganMagangService();
    }

    function testTerimaLowonganFailed()
    {
        $idPencariMagang = 0;
        $idMagang = 1;
        $response = $this->service->terimaMagang($idPencariMagang, $idMagang);
        assertEquals("failed", $response['status']);
    }

    function testTerimaLowonganSuccess()
    {
        $idPencariMagang = 146;
        $idMagang = 132;
        $response = $this->service->terimaMagang($idPencariMagang, $idMagang);
        var_dump($response);
        assertEquals("oke", $response['status']);
    }

    function testShowPemagang()
    {
        $response = $this->service->showPemagang(87);
        assertEquals("oke", $response['status']);
    }

    function testSendLamaran()
    {
        $response = $this->service->sendEmailTerimaLamaran(146, 154);
        var_dump($response);
    }
}
