<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\dto\AktivasiAkunRequest;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\RegisterPencariMagangRequest;
use LearnPhpMvc\dto\RegisterPenyediaRequest;
use LearnPhpMvc\dto\UpdatePencariMagangRequest;
use LearnPhpMvc\repository\PencariMagangRepository;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class PenyediaMagangServiceTest extends TestCase
{

    public PenyediaMagangService $service;


    function setUp(): void
    {
        $this->service = new PenyediaMagangService();
    }
//
//    function testRegisterSuccess()
//    {
//        $request = new RegisterPenyediaRequest();
//        $request->setEmail('mohammadtajutzamzasmis07@gmail.com');
//        $request->setUsername('Synzs');
//        $request->setJenis_usaha(1);
//        $request->setNama_perusahaan('polije');
//        $request->setNo_telp('0823123');
//        $request->setRole(5);
//        $request->setPassword("rahasia");
//        $request->setToken('asdasdasdasdasda');
//        $response =  $this->service->register($request);
//        assertEquals("ok", $response['status']);
//    }

    public function testFindByUsename()
    {
        $response = $this->service->findByUsername("Synz");
        var_dump($response);
    } 
    public function testRegister()
    {
        $request = new RegisterPenyediaRequest();
        $request->setEmail('mohammadtajutzamzasmis07@gmail.com');
        $request->setUsername('Synzasdasdass');
        $request->setJenis_usaha(1);
        $request->setNama_perusahaan('polije');
        $request->setNo_telp('0823123');
        $request->setRole(5);
        $request->setPassword("rahasia");
        $request->setToken('asdasdasdasdasda');
        $response =  $this->service->register($request);
        assertEquals("ok", $response['status']);
    }
    public function testUpdate()
    {
    $request = new AktivasiAkunRequest();
    $request->setUsername('Synz');
    $arr =  $this->service->updateStatusUser($request);
    var_dump($arr);
    
    }
    public function testLogin()
    {
    $request = new LoginRequest();
    $request->username = 'Zam';
    $request->password = "rahasia";
    $arr =  $this->service->login($request);
    assertEquals("oke" , $arr['status']);
    }

    public function testLoginFailed()
    {
    $request = new LoginRequest();
    $request->username = 'Zam';
    $request->password = "rahasias";
    $arr =  $this->service->login($request);
    assertEquals("failed" , $arr['status']);
    assertEquals("username atau password salah" , $arr['message']);
    var_dump($arr);
    }
    
}


