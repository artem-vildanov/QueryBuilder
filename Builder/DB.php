<?php

namespace QueryBuilder\Builder;

class DB
{
    public static function query(): Builder
    {
         return new BuilderImp();
    }
}