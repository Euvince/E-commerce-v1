<?php

namespace Models;

use PDO;

class GeneralManager extends Model
{

    public static function getNumberPagesOfElements ($table): ?int
    {
        $query = "SELECT count(id) FROM {$table}";
        $fetch = self::getPDO()->prepare($query);
        $fetch->execute();
        $perPage = 10;
        $count = $fetch->fetch(PDO::FETCH_NUM)[0];
        $pages = ceil($count / $perPage);
        return $pages;
    }

    public static function loadElements(
        string $table, 
        ?int $page = null, 
        string $searching = "",
        ?int $id = null 
    ): array
    {
        $perPage = 40;
        $currentPage = (int)$page;
        $perPage = 50;
        $offset = $perPage * ($currentPage - 1);
        $req = "SELECT * FROM {$table}";
        $s = htmlspecialchars($searching);
        if ($s !== "")
        {
            $req .= " WHERE CONCAT(title, content) like '%$s%'";
        }
        if ($id !== null)
        {
            $req .= " WHERE id = :id";
        }
        $req .= " LIMIT {$perPage} OFFSET {$offset}";
        $stmt = self::getPDO()->prepare($req);
        if ($id !== null)
        {
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        }
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($id !== null)
        {
            return $stmt->fetch();
        }
        $myElements = $stmt->fetchAll();

        return $myElements;
    } 

    public static function insertElementIntoDatabase(
        string $table, 
        $title, 
        $content, 
        $picture,
        $price
    ): bool
    {
        $req = "INSERT INTO {$table}(title, content, picture, price) VALUES (:title, :content, :picture, :price)";
        $stmt = self::getPDO()->prepare($req);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":content", $content, PDO::PARAM_STR);
        $stmt->bindValue(":picture", $picture, PDO::PARAM_STR);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $result = $stmt->execute();

        $stmt->closeCursor();

        if ($result > 0) { return true; }
        else { return false; }
    }

    public static function deleteElementOfDatabase($table, $id): bool
    {
        $req = "DELETE FROM {$table} WHERE id = :id";
        $stmt = self::getPDO()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $result = $stmt->execute();

        $stmt->closeCursor();

        if ($result > 0){ return true; }
        else { return false; }
    }

    public static function editElementIntoDatabase(
        string $table,
        $id, 
        $title, 
        $content, 
        $picture,
        $price): bool
    {
        $req = "UPDATE {$table} SET title = :title, content = :content, picture = :picture, price = :price WHERE id = :id";
        $stmt = self::getPDO()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":content", $content, PDO::PARAM_STR);
        $stmt->bindValue(":picture", $picture, PDO::PARAM_STR);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $result = $stmt->execute();

        $stmt->closeCursor();

        if ($result > 0){ return true; }
        else { return false; }
    }
}