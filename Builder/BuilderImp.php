<?php

namespace QueryBuilder\Builder;

use DatabaseConnection;
use PDO;
use stdClass;

require_once 'Database/DatabaseConnection.php';
require_once 'Query.php';
require_once 'Builder.php';

/**
 * Используя паттерн builder
 */
class BuilderImp implements Builder
{
    private PDO $pdo;
    private Query $query;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::getConnection();
        $this->query = new Query();
    }

    public function table(string $table): BuilderImp
    {
        $this->query->table = $table;
        return $this;
    }

    public function select(array $fields): BuilderImp
    {
        $this->query->select = $fields;
        return $this;
    }

    public function where(string $field, string $value): BuilderImp
    {
        $this->query->where[$field] = $value;
        return $this;
    }

    public function orderBy($field, $direction = 'ASC'): BuilderImp
    {
        $this->query->orderBy = "$field $direction";
        return $this;
    }

    /**
     * @return stdClass[]
     */
    public function getAll(): array
    {
        $pdoStatement = $this->build();
        return $pdoStatement->fetchAll(PDO::FETCH_OBJ);
    }

    public function getFirst(): stdClass
    {
        $pdoStatement = $this->build();
        return $pdoStatement->fetchObject();
    }

    private function build(): \PDOStatement|false
    {
        $sqlQuery = $this->query->makeSqlQuery();
        return $this->pdo->query($sqlQuery);
    }
}







