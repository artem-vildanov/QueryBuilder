<?php

require_once 'Builder/BuilderImp.php';
require_once 'Builder/DB.php';

use QueryBuilder\Builder\DB;

class UserRepository
{
    public function getById(int $id): stdClass
    {
        return DB::query()
            ->table('users')
            ->where('id', $id)
            ->getFirst();
    }

    public function getAllEmailsByName(string $name): array
    {
        return DB::query()
            ->select(['email'])
            ->table('users')
            ->where('name', $name)
            ->getAll();
    }
}