<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\RegisterPencariMagangRequest;
use LearnPhpMvc\repository\PencariMagangRepository;
use PHPUnit\Framework\TestCase;

class PencariMagangServiceTest extends TestCase
{

    public PencariMagangService $service;

    protected function setUp() : void
    {
        $repository = new PencariMagangRepository(Database::getConnection());
        $this->service = new PencariMagangService($repository);
    }

    public function testFindAll()
    {
        $result = $this->service->findAll();
       var_dump($result);
    }

    public function testLoginSucces()
    {
        $loginRe = new LoginRequest();
        $loginRe->username = "zam baruasdasdasd";
        $loginRe->password = "zam baru";
        $arr = $this->service->login($loginRe);
        self::assertEquals('ok' , $arr['status']);
    }
    public function testLoginFailed()
    {
        $loginRe = new LoginRequest();
        $loginRe->username = "zam baru";
        $loginRe->password = "zam barasdasu";
        $arr = $this->service->login($loginRe);
        self::assertEquals('failed' , $arr['status']);
    }

    public function testRegister()
    {
        $request = new RegisterPencariMagangRequest();
        $request->setUsername("adminsasdasdassaasdsasdasasdasdsdfdasdad");
        $request->setPassword("aming");
        $request->setRole(3);
        $request->setToken("asdasdasdassad");
        $request->setEmail("zam@space.com");
        $request->setIdSekolah(24);
        $request->setFoto("imadasda.jpg");
        $request->setResume("asdasodasod.resume");
        $request->setCv("asdasdas.cv");
        $request->setAgama("islam");
        $request->setAlamat("adasdasd");
        $request->setNamaBelakang("tajut");
        $request->setNamaDepan("zan");
        $request->setNotelp("08123123");
        $request->setSkill("adasdas, asdasd , asdasd");
        $arr = $this->service->register($request);
        self::assertEquals("oke" , $arr['status']);
        var_dump($arr);
    }
    public function testRegisterFailedNullExeption()
    {
        $request = new RegisterPencariMagangRequest();
        $request->setUsername("");
        $request->setPassword("aming");
        $request->setRole(3);
        $request->setToken("asdasdasdassad");
        $request->setEmail("zam@space.com");
        $request->setIdSekolah(24);
        $request->setFoto("imadasda.jpg");
        $request->setResume("asdasodasod.resume");
        $request->setCv("asdasdas.cv");
        $request->setAgama("islam");
        $request->setAlamat("adasdasd");
        $request->setNamaBelakang("tajut");
        $request->setNamaDepan("zan");
        $request->setNotelp("08123123");
        $request->setSkill("adasdas, asdasd , asdasd");
        $arr = $this->service->register($request);
        self::assertEquals("failed" , $arr['status']);
        self::assertEquals("harap isi semua field" , $arr['message']);
    }
    public function testRegisterFailedPdoExeption()
    {
        $request = new RegisterPencariMagangRequest();
        $request->setUsername("admin");
        $request->setPassword("aming");
        $request->setRole(3);
        $request->setToken("asdasdasdassad");
        $request->setEmail("zam@space.com");
        $request->setIdSekolah(24);
        $request->setFoto("imadasda.jpg");
        $request->setResume("asdasodasod.resume");
        $request->setCv("asdasdas.cv");
        $request->setAgama("islam");
        $request->setAlamat("adasdasd");
        $request->setNamaBelakang("tajut");
        $request->setNamaDepan("zan");
        $request->setNotelp("08123123");
        $request->setSkill("adasdas, asdasd , asdasd");
        $arr = $this->service->register($request);
        self::assertEquals("terjadi kesalahan" , $arr['status']);
    }


}
