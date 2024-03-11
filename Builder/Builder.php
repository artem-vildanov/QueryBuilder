<?php

namespace QueryBuilder\Builder;

interface Builder
{
    public function table(string $table): Builder;

    public function select(array $fields): Builder;

    public function where(string $field, string $value): Builder;

    public function orderBy($field, $direction = 'ASC'): Builder;

    public function getAll(): array;

    public function getFirst(): \stdClass;
}