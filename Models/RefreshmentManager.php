<?php

namespace Models;

use Exception;
use PDO;

class RefreshmentManager extends Model
{

    private $refreshments;

    public function addRefreshment ($refreshment)
    {
        $this->refreshments[] = $refreshment;
    }

    public function getRefreshments (): array
    {
        return $this->refreshments;
    }

    public function loadRefreshments (?int $np = null, ?string $searching = "")
    {
        foreach (GeneralManager::loadElements('refreshments', $np, $searching) as $refreshment):
            $r = new Refreshment($refreshment['id'], $refreshment['title'], $refreshment['content'], $refreshment['price'], $refreshment['picture'], $refreshment['created_at']);
            $this->addRefreshment($r);
        endforeach;
    }

    public function getRefreshmentByid($id)
    {
        for ($i = 0; $i < count($this->refreshments); $i++):
            if ($this->refreshments[$i]->getId() == $id):
                return $this->refreshments[$i];
            endif;
        endfor;
        throw new Exception("LE RAFRAÎCHISSEMENT N'EXISTE PAS !");
    }

    public function insertRefreshmentIntoDatabase($title, $content, $picture, $price)
    {
        $result = GeneralManager::insertElementIntoDatabase('refreshments', $title, $content, $price, $picture);
        if ($result === true)
        {
            $refreshment = new Refreshment (
                $this->getPDO()->lastInsertId(), 
                $title, $content, $price, $picture
            );
            $this->addRefreshment($refreshment);
        }
    }

    public function deleteRefreshmentOfDatabase($id)
    {
        $result = GeneralManager::deleteElementOfDatabase('refreshments', $id);
        if ($result === true):
            $refreshment = $this->getRefreshmentByid($id);
            unset($refreshment);
        endif;
    }

    public function editRefreshmentIntoDatabase($id, $title, $content, $picture, $price)
    {
        $result = GeneralManager::editElementIntoDatabase('refreshments', $id, $title, $content, $price, $picture);
        if ($result === true)
        {
            $this->getRefreshmentByid($id)->setTitle($title);
            $this->getRefreshmentByid($id)->setContent($content);
            $this->getRefreshmentByid($id)->setPicture($picture);
        }
    }
    
}