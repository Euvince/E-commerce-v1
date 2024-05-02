<?php

namespace Models;

use Exception;

class DishManager extends Model
{
    private $dishes;

    public function addDish ($dish)
    {
       $this->dishes[] = $dish;
    }

    public function getDishes (): array
    {
        return $this->dishes;
    }

    public function loadDishes (?int $np = null, ?string $searching = ""): void
    {
        foreach (GeneralManager::loadElements('dishes', $np, $searching) as $dish):
            $d = new Dish($dish['id'], $dish['title'], $dish['content'], $dish['price'],$dish['picture'], $dish['created_at']);
            $this->addDish($d);
        endforeach;
    }

    public function getDishById ($id)
    {
        for ($i = 0; $i < count($this->dishes); $i++):
            if ($this->dishes[$i]->getId() == $id):
                return $this->dishes[$i];
            endif;
        endfor;
        throw new Exception("LE PLAT N'EXISTE PAS !");
    }

    public function insertDishIntoDatabase($title, $content, $picture, $price)
    {
        $result = GeneralManager::insertElementIntoDatabase('dishes', $title, $content, $price, $picture);
        if ($result === true)
        {
            $dish = new Dish (
                $this->getPDO()->lastInsertId(), 
                $title, $content,$price, $picture
            );
            $this->addDish($dish);
        }
    }

    public function deleteDishOfDatabase($id)
    {
        $result = GeneralManager::deleteElementOfDatabase('dishes', $id);
        if ($result === true):
            $dish = $this->getDishByid($id);
            unset($dish);
        endif;
    }

    public function editDishIntoDatabase($id, $title, $content, $picture, $price)
    {
        $result = GeneralManager::editElementIntoDatabase('dishes', $id, $title, $content, $price, $picture);
        if ($result === true)
        {
            $this->getDishByid($id)->setTitle($title);
            $this->getDishByid($id)->setContent($content);
            $this->getDishByid($id)->setPicture($picture);
        }
    }

}