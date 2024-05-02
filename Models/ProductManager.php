<?php

namespace Models;

use Exception;
use PDO;


class ProductManager extends Model
{

    private $products;

    public function addProduct ($product)
    {
        $this->products[] = $product;
    }

    public function getProducts (): array
    {
        if($this->products === null) throw new Exception('Aucun Produit ne correspond à votre Recherche');
        return $this->products;
    }

    public function loadProducts (?int $np = null, ?string $searching = "")
    {
        foreach (GeneralManager::loadElements('products', $np, $searching) as $product):
            $p = new Product($product['id'], $product['title'], $product['content'], $product['price'], $product['picture'], $product['created_at']);
            $this->addProduct($p);
        endforeach;
    }

    public function getProductByid($id)
    {
        for ($i = 0; $i < count($this->products); $i++):
            if ($this->products[$i]->getId() == $id)
            {
                return $this->products[$i];
            }
        endfor;
        throw new Exception("LE PRODUIT N'EXISTE PAS !");
    }

    public function insertProductIntoDatabase($title, $content, $picture, $price)
    {
        $result = GeneralManager::insertElementIntoDatabase('products', $title, $content, $price, $picture);
        if ($result === true)
        {
            $product = new Product (
                $this->getPDO()->lastInsertId(), 
                $title, $content, $price, $picture
            );
            $this->addProduct($product);
        }
    }

    public function deleteProductOfDatabase($id)
    {
        $result = GeneralManager::deleteElementOfDatabase('products', $id);
        if ($result === true):
            $product = $this->getProductByid($id);
            unset($product);
        endif;
    }

    public function editProductIntoDatabase($id, $title, $content, $picture, $price)
    {
        $result = GeneralManager::editElementIntoDatabase('products', $id, $title, $content, $price, $picture);
        if ($result === true)
        {
            $this->getProductByid($id)->setTitle($title);
            $this->getProductByid($id)->setContent($content);
            $this->getProductByid($id)->setPicture($picture);
        }
    }

}