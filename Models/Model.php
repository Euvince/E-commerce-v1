<?php

namespace Models;

use PDO;

class Model
{
    private static $pdo;

    public static function getPDO(): PDO
    {
        if (!self::$pdo):
            self::$pdo = new PDO("mysql:host=localhost:3306;dbname=chez_euvince_final", 'root', '', [
                \PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        endif;

        return self::$pdo;
    } 

    public static function getNbPages (string $table): ?int
    {
        return GeneralManager::getNumberPagesOfElements($table);
    }

}