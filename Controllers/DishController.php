<?php

namespace Controllers;

use Models\DishManager;

class DishController extends GeneralController
{
    private $dishManager;

    private $np;

    public function __construct (?int $np = null)
    {
        $searching = $_POST['searching'] ?? "";
        $this->np = $np;
        $this->dishManager = new DishManager;
        $this->dishManager->loadDishes($this->np, $searching);
    }

    public function displayDishes ()
    {
        $nbp = $this->dishManager->getNbPages('dishes');
        $dishes = $this->dishManager->getDishes();
        require "Views/dishes.php";
    }

    public function displayDish ($id)
    {
        $dish = $this->dishManager->getDishById($id);
        require "Views/displayDish.php";
    }

    public function displayTechnicalSheet($id)
    {
        $dish = $this->dishManager->getDishById($id);
        require "Views/dishSheet.php";
    }

    public function addDish()
    {
        require "Views/addDish.php";
    }

    public function addDishValidate ()
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
                $this->dishManager, 
                'insertDishIntoDatabase', 
                'Ajout', 'Plat', 'réalisé'
            );
        header('Location:' . URL . 'plats'); 
    }

    public function deleteDish ($id)
    {
        $pictureName = $this->dishManager->getDishByid($id)->getPicture();
        if(file_exists(URL . 'img' . DIRECTORY_SEPARATOR . $pictureName)) unlink('img/'.$pictureName);
        $this->dishManager->deleteDishOfDatabase($id);
        GeneralController::alertMsg('Suppression', 'Plat', 'réalisée');
        header('Location:' . URL . 'plats'); 
    }

    public function editDish($id)
    {
        $dish = $this->dishManager->getDishByid($id);
        require "Views/editDish.php";
    }

    public function editDishValidate ()
    {
        $currentPicture = $this
                ->dishManager
                ->getDishByid(
                    $_POST['identifiant']
                )->getPicture();
        $generalController = new GeneralController(
                    $_FILES['picture'], "img/", 
                    $_POST['title'], 
                    $_POST['content'],
                    $_POST['price'], 
                    $_POST['identifiant']
                );
        $generalController->
            editElementValidate(
                $currentPicture, 
                $this->dishManager, 
                'editDishIntoDatabase', 
                'Modification', 'Plat', 
                'réalisée'
            );
        header('Location:' . URL . 'plats'); 
    }

}