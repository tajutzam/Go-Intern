<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\RegisterPencariMagangRequest;
use LearnPhpMvc\dto\UpdatePencariMagangRequest;
use LearnPhpMvc\repository\PencariMagangRepository;
use LearnPhpMvc\repository\SkillRepository;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class PencariMagangServiceTest extends TestCase
{

    public PencariMagangService $service;

    protected function setUp(): void
    {
        $repository = new PencariMagangRepository(Database::getConnection());
        $skilRepo = new SkillRepository(Database::getConnection());
        $this->service = new PencariMagangService($repository, $skilRepo);
    }

    public function testFindAll()
    {
        $result = $this->service->findAll();
        var_dump($result);
    }

    public function testLoginSucces()
    {
        $loginRe = new LoginRequest();
        $loginRe->username = "Zam";
        $loginRe->password = "rahasia";
        $arr = $this->service->login($loginRe);
        var_dump($arr);
    }
    public function testLoginFailed()
    {
        $loginRe = new LoginRequest();
        $loginRe->username = "zam baru";
        $loginRe->password = "zam barasdasu";
        $arr = $this->service->login($loginRe);
        var_dump($arr);
        self::assertEquals('failed', $arr['status']);
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
        self::assertEquals("oke", $arr['status']);
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
        self::assertEquals("failed", $arr['status']);
        self::assertEquals("harap isi semua field", $arr['message']);
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
        self::assertEquals("terjadi kesalahan", $arr['status']);
    }

    public function testUpdateUserByIdSuccess()
    {
        $request = new UpdatePencariMagangRequest();
        $byUsername = $this->service->findById(19);
        $request->setUsername($byUsername->getUsername());
        $request->setPassword($byUsername->getPassword());
        $request->setNama("zam");
        $request->setEmail("Asdas");
        $request->setAgama("Asdas");
        $request->setTanggalLahir("asdasd");
        $request->setFoto("asdasdasd");
        $request->setCv("dasdasdakso");
        $request->setResume("asdasdsa");
        $request->setId(19);
        $request->setNo_telp("Asdasd");
        $request->setId_sekolah(12);
        $updateData = $this->service->updateData($request);
        self::assertEquals("Berhasil Update data", $updateData['message']);
        self::assertEquals("ok", $updateData['status']);
    }

    public function testUpdateTentangSaya()
    {
        $response = $this->service->updateTentangSaya("tentang-saya.pdf", 72);
        assertEquals('oke', $response['status']);
    }

    public function testUpdateDeskripsiSekolah()
    {
        $response = $this->service->updateDeskripsi('beru deskripsi', 103);
        assertEquals('oke', $response['status']);
    }

    public function testUpdateKeamanan()
    {
        $pencari = new PencariMagang();

        $response =  $this->service->updateKeamann("Fira baru", "asd", 170);
        var_dump($response);
    }

    public function testupdatePasswordById(){
        $response = $this->service->updatePasswordById("rahasia baru" , 17);
        echo http_response_code();
        var_dump($response);
    }
}
