<?php

class DatabaseConnection
{
    private static ?PDO $pdo = null;

    private function __construct() {}

    public static function getConnection(): PDO
    {
        if (!self::$pdo) {
            self::$pdo = self::setConnection();
        }

        return self::$pdo;
    }

    private static function setConnection(): PDO
    {
        $databaseFile = 'Database/database.sqlite';

        $pdo = new PDO("sqlite:$databaseFile");

        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        return $pdo;
    }
}