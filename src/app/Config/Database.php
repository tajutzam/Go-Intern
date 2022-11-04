<?php

namespace LearnPhpMvc\Config;

use phpDocumentor\Reflection\Types\Self_;

class Database
{
    private static ?\PDO $pdo = null;

    private function __construct()
    {
    }

    public static function getConnection(string $env = "test"): \PDO
    {
        require_once __DIR__ . "/../../config/dbconfig.php";
        $config = getDbConfig();
        if (self::$pdo == null) {
            self::$pdo = new \PDO(
                $config['database'][$env]['url'],
                $config['database'][$env]['username'],
                $config['database'][$env]['password']
            );
        }
        return self::$pdo;
    }
    public function begintTrancsaction()
    {
        self::$pdo->beginTransaction();
    }
    public function commitTransaction()
    {
        self::$pdo->commit();
    }
    public function rollback()
    {
        self::$pdo->rollBack();
    }
}
