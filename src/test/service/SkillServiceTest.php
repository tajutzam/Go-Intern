<?php

namespace LearnPhpMvc\service;

use PHPUnit\Framework\TestCase;

class SkillServiceTest extends TestCase
{
    private SkillService $service;

    protected function setUp() : void
    {
        $this->service = new SkillService();
    }

    public function testDeleteById()
    {
        $byId = $this->service->deleteById(4);
        self::assertEquals("ok" , $byId['status']);
    }

    public function testDeleteByIdFailed()
    {
        $byId = $this->service->deleteById(4);
        self::assertEquals("failed" , $byId['status']);
    }


}
