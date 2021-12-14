<?php

class Database
{
    private static $dbo = null;
    private static $pdo = null;

    private function __construct()
    {
        try {
            self::$pdo = new PDO(DB_TYPE . ':host=' . DB_HOST . ';port=' . DB_PORT . ';charset=utf8mb4;dbname=' . DB_NAME, DB_USER, DB_PASS);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public static function getConnection()
    {
        if (self::$dbo === null) {
            self::$dbo = new self;
        }
        return self::$pdo;
    }
}