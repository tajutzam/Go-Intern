<?php

use LearnPhpMvc\dto\MagangRequest;
use LearnPhpMvc\service\MagangService;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class MagangServiceTest extends TestCase
{


    private MagangService $service;


    function setUp(): void
    {
        $this->service = new MagangService();
    }

    function testSave()
    {
        $request = new MagangRequest();
        $request->setPosisi_magang('Backend enginer');
        $request->setJumlah_maksimal(4);
        $request->setLama_magang(4);
        $request->setPenyedia(41);
        $result =  $this->service->addMagang($request);
        assertNotNull($result);
        assertEquals('oke', $result['status']);
    }

    function testFindAll()
    {
        $result = $this->service->findAll();
        assertEquals('oke', $result['status']);
    }

    function testShowMagang(){
        $result = $this->service->showMagang();
        assertNotNull($result);
    }

    function testUpdate(){
        $magangRequest = new MagangRequest();
        $magangRequest->setPosisi_magang('backend baru');
        $magangRequest->setKategori(1);
        $magangRequest->setLama_magang(2);
        $magangRequest->setJumlah_maksimal(2);
        $magangRequest->setDeskripsi("deskripsi backend baru");
        $magangRequest->setId(37);
        $response = $this->service->updateData($magangRequest);
        assertNotNull($response);
        assertEquals("oke" , $response['status']);
    }

    function testShowOnMobile(){
        $response = $this->service->showMagangOnMobile();
        var_dump($response);
        assertEquals(200 , http_response_code());
    }
}
