<?php

namespace LearnPhpMvc\Config;

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{


    public function testConnection()
    {
      $connection = Database::getConnection();
      self::assertNotNull($connection);
    }

    public function testSinggleTonConnection()
    {
        $connection = Database::getConnection();
        $connection1 = Database::getConnection();
        self::assertSame($connection , $connection1);
    }

}
