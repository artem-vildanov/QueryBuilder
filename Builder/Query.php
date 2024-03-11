<?php

namespace QueryBuilder\Builder;

class Query
{
    public string $table = '';
    public array $select = [];
    public array $where = [];
    public string $orderBy = '';

    public function makeSqlQuery(): string
    {
        $select = $this->makeSelect();
        $table = $this->makeFrom();
        $where = $this->makeWhere();
        $orderBy = $this->makeOrderBy();

        return $select . $table . $where . $orderBy;
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

    private function makeOrderBy(): string
    {
        if (!empty($this->orderBy)) {
            return " ORDER BY " . $this->orderBy;
        } else {
            return '';
        }
    }
}