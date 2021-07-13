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
    public $lastId;

    public function __construct()
    {
        $this->pdo = $this->getConnection();
        $this->factory = new QueryFactory($_ENV['DB_CONNECTION']);
    }
    public function getConnection()
    {
        return new \PDO("{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    }

    public function createAds($table, $data)
    {
        $insert = $this->factory->newInsert();
        $insert->into($table)
            ->cols($data);
        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
        $this->lastId = $this->pdo->lastInsertId();
    }

    public function relevant($table)
    {
        $select = $this->factory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where('show_count < limit')
            ->orderBy(['price DESC'])
            ->limit(1);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());

        var_dump($sth->fetch(\PDO::FETCH_ASSOC));
    }
}
