<?php
/**
 * Класс для работы с бд
 */
namespace App\Components;

use Aura\SqlQuery\QueryFactory;

class Database
{
    private $pdo;
    private $factory;

    public function __construct()
    {
        $this->pdo = $this->getConnection();
        $this->factory = new QueryFactory($_ENV['DB_CONNECTION']);
    }
    public function getConnection()
    {
        return new \PDO("{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    }

    public function createAds()
}
