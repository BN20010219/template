<?php

namespace App\Models;

class Base_Model
{
    protected static $pdo;

    public function __construct()
    {
        if (!self::$pdo) {
            $dbConfig = require BASE_PATH . '/config/database.php';
            $dsn = "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['database']};charset=utf8mb4";

            self::$pdo = new \PDO(
                $dsn,
                $dbConfig['username'],
                $dbConfig['password'],
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                ]
            );
        }
    }

    protected function get_PDO()
    {
        return self::$pdo;
    }
}
