<?php

namespace Controllers;

use Models\ProductManager;

class ProductController extends GeneralController
{

    private $productManager;

    private $np;

    public function __construct(?int $np = null)
    {
        $searching = isset($_POST['searching']) ? htmlspecialchars($_POST['searching']) : "";
        $this->np = $np;
        $this->productManager = new ProductManager;
        $this->productManager->loadProducts($this->np, $searching);
    }

    public function displayProducts (): void
    {
       $nbp = $this->productManager->getNbPages('products');
       $products = $this->productManager->getProducts();
       require "Views/products.php";
    }

    public function displayProduct($id): void
    {
       $product = $this->productManager->getProductByid($id);
       require "Views/displayProduct.php";
    }

    public function displayTechnicalSheet($id)
    {
        $product = $this->productManager->getProductByid($id);
        require "Views/productSheet.php";
    }

    public function addProduct(): void
    {
        require "Views/addProduct.php";
    }

    public function addProductValidate()
    {
        $generalController = new GeneralController(
            $_FILES['picture'], 
            "img/", 
            $_POST['title'], 
            $_POST['content'],
            $_POST['price']
        );
        $generalController
            ->addElementValidate(
                $this->productManager, 
                'insertProductIntoDatabase', 
                'Ajout', 'Produit', 'réalisé'
            );
        header('Location:' . URL . 'produits');
    }

    public function deleteProduct ($id)
    {
        $pictureName = $this->productManager->getProductByid($id)->getPicture();
        if(file_exists(URL . 'img' . DIRECTORY_SEPARATOR . $pictureName)) unlink('img/'.$pictureName);
        $this->productManager->deleteProductOfDatabase($id);
        GeneralController::alertMsg('Suppression', 'Produit', 'réalisée');
        header('Location:' . URL . 'produits'); 
    }

    public function editProduct($id)
    {
        $product = $this->productManager->getProductByid($id);
        require "Views/editProduct.php";
    }

    public function editProductValidate ()
    {
        $currentPicture = $this
                ->productManager
                ->getProductByid(
                    $_POST['identifiant']
                )->getPicture();
        $generalController = new GeneralController(
                    $_FILES['picture'], "img/", 
                    $_POST['title'], 
                    $_POST['content'], 
                    $_POST['price'],
                    $_POST['identifiant']
                );
        $generalController
            ->editElementValidate(
                $currentPicture, 
                $this->productManager, 
                'editProductIntoDatabase', 
                'Modification', 'Produit', 
                'réalisée'
            );
        header('Location:' . URL . 'produits'); 
    }

}