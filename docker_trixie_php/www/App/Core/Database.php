<?php

namespace App\Core;

class Database
{
    public static $pdo;

    public function __construct()
    {
        if (!self::$pdo) {
            $dsn = sprintf(
                '%s:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                $_ENV['DB_CONNECTION'] ?? '',
                $_ENV['DB_HOST'] ?? '',
                $_ENV['DB_PORT'] ?? '',
                $_ENV['DB_DATABASE'] ?? ''
            );

            $username = $_ENV['DB_USERNAME'] ?? '';
            $password = $_ENV['DB_PASSWORD'] ?? '';
            self::$pdo = new \PDO(
                $dsn,
                $username,
                $password,
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

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(BASE_PATH . '/migrations');
        $toAppliedMigrations = array_diff($files, $appliedMigrations);

        foreach ($toAppliedMigrations as $migration){
            if ($migration === '.' || $migration === '..'){
                continue;
            }

            require_once BASE_PATH . '/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration");

            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All Migrations are applied");
        }
        
    }
    public function createMigrationsTable()
    {
        self::$pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations() 
    {
        $statement = self::$pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $str = implode(",",array_map(fn($m) => "('$m')", $migrations));
        $statement = self::$pdo->prepare("INSERT INTO migrations (migration) VALUES $str");
        $statement->execute();
    }

    protected function log($message){
        echo '['.date('Y-m-d H:i:s').'] - '. $message . PHP_EOL;
    }
}
