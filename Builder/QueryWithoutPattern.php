<?php

namespace QueryBuilder\Builder;

class QueryWithoutPattern
{
    private string $table = '';
    private array $select = [];
    private array $where = [];
    public function __construct(
        string $inputTable,
        array $inputSelect,
        array $inputWhere
    )
    {
        $this->table = $inputTable;
        $this->select = $inputSelect;
        $this->where = $inputWhere;
    }

    public function makeSqlQuery(): string
    {
        $select = $this->makeSelect();
        $table = $this->makeFrom();
        $where = $this->makeWhere();

        return $select . $table . $where;
    }

    private function makeSelect(): string
    {
        $sqlSelect = "SELECT ";

        if (!$this->select) {
            return $sqlSelect . "*";
        }

        return $sqlSelect . implode(', ', $this->select);
    }

    private function makeFrom(): string
    {
        return " FROM " . $this->table;
    }

    private function makeWhere(): string
    {
        if (!empty($this->where)) {
            $whereClauses = [];
            foreach ($this->where as $field => $value) {
                $whereClauses[] = "$field = '$value'";
            }
            return " WHERE " . implode(' AND ', $whereClauses);
        } else {
            return '';
        }
    }
}