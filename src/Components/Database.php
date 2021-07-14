<?php

namespace App\Components;

use Aura\SqlQuery\QueryFactory;

/**
 * Adapter for PDO and SQLQuery
 */
class Database
{
    public $lastId;
    private $pdo;
    private $factory;
    private $updatingAds;

    public function __construct()
    {
        $this->pdo = $this->getConnection();
        $this->factory = new QueryFactory($_ENV['DB_CONNECTION']);
    }

    /**
     * Create new PDO connection
     *
     * @return object
     */
    public function getConnection()
    {
        return new \PDO("{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    }

    /**
     * Create new advertisement
     *
     * @param string $table
     * @param array $data
     * @return void
     */
    public function createAds(string $table, array $data)
    {
        $insert = $this->factory->newInsert();
        $insert->into($table)
            ->cols($data);
        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
        $this->lastId = $this->pdo->lastInsertId();
    }

    /**
     * Return advertisement with the highest price
     *
     * @param string $table
     * @return array
     */
    public function relevant(string $table): array
    {
        $select = $this->factory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where('ads.show_count < ads.limit')
            ->orderBy(['ads.price DESC'])
            ->limit(1);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());

        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Updating advertisement
     *
     * @param string $table
     * @param integer $id
     * @param array $data
     * @return void
     */
    public function updateAds(string $table, int $id, array $data)
    {
        $update = $this->factory->newUpdate();
        $update->table($table)
            ->cols($data)
            ->where('id=:id')
            ->bindValues(['id' => $id]);
        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());
        $this->updatingAds = $this->getOne($table, $id);
    }

    /**
     * Return last updating record
     *
     * @return array
     */
    public function getUpdatingAds(): array
    {
        return $this->updatingAds;
    }

    /**
     * Finds and returns an entry by id
     *
     * @param string $table
     * @param integer $id
     * @return array
     */
    private function getOne(string $table, int $id): array
    {
        $select = $this->factory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where('id=:id')
            ->bindValues(['id' => $id]);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }
}
