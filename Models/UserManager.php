<?php

namespace Models;

use Exception;
use PDO;

class UserManager extends Model
{
    private $users = [];

    public function addUser ($user)
    {
       $this->users[] = $user;
    }

    public function getUsers (): array
    {
        return $this->users;
    }

    public function loadUsers (string $searching = ""): void
    {
        $req = "SELECT * FROM users ";
        if ($searching !== "")
        {
            $req .= " WHERE CONCAT(user_name, mail, password) like '%$searching%'";
        }
        $req .= " ORDER BY id ASC";
        $stmt = $this->getPDO()->prepare($req);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $users = $stmt->fetchAll();
        array_map(function($user){
            $u = new User($user['id'], $user['user_name'], $user['mail'], $user['password'], $user['picture']);
            $this->addUser($u);
        }, $users);
    }

    public function getUserById ($id)
    {
        for ($i = 0; $i < count($this->users); $i++):
            if ($this->users[$i]->getId() == $id):
                return $this->users[$i];
            endif;
        endfor;
    }

    public function findUserByMail (string $mail)
    {
        for ($i = 0; $i < count($this->users); $i++):
            if ($this->users[$i]->getMail() == $mail): return $this->users[$i];
            return null;
            endif;
        endfor;
    }

    public function findUserByUsername (string $user_name)
    {
        for ($i = 0; $i < count($this->users); $i++):
            if ($this->users[$i]->getUsername() == $user_name): return $this->users[$i];
                return null;
            endif;
        endfor;
    }

    public function insertUserIntoDatabase($user_name, $mail, $password, $picture)
    {
        $req = "INSERT INTO users(user_name, mail, password, picture) VALUES (:user_name, :mail, :password, :picture)";
        $stmt = self::getPDO()->prepare($req);
        $stmt->bindValue(":user_name", $user_name, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->bindValue(":picture", $picture, PDO::PARAM_STR);
        $result = $stmt->execute();

        $stmt->closeCursor();

        if ($result > 0)
        {
            $user = new User(
                $this->getPDO()->lastInsertId(), 
                $user_name, $mail, $password, $picture
            );
            $this->addUser($user);
        }
    }

    public function deleteUserOfDatabase($id)
    {
        $req = "DELETE FROM users WHERE id = :id";
        $stmt = $this->getPDO()->prepare($req);
        $result = $stmt->execute(['id' => $id]);
        $stmt->closeCursor();

        if ($result > 0)
        {
            $user = $this->getUserById($id);
            unset($user);
        }
    }

    public function editUserIntoDatabase($id, $user_name, $mail, $password, $picture)
    {
        $req = "UPDATE users SET user_name = :user_name, mail = :mail, password = :password, picture = :picture WHERE id = :id";
        $stmt = self::getPDO()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":user_name", $user_name, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->bindValue(":picture", $picture, PDO::PARAM_STR);
        $result = $stmt->execute();

        $stmt->closeCursor();
        if ($result > 0):
            $this->getUserById($id)->setUserName($user_name);
            $this->getUserById($id)->setMail($mail);
            $this->getUserById($id)->setPassword($password);
            $this->getUserById($id)->setPicture($picture);
        endif;
    }

}