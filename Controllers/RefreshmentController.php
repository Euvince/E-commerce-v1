<?php

namespace Controllers;

use Models\RefreshmentManager;

class RefreshmentController extends GeneralController
{
    private $refreshmentManager;

    private $np;

    public function __construct (?int $np = null)
    {
        $searching = $_POST['searching'] ?? "";
        $this->np = $np;
        $this->refreshmentManager = new  RefreshmentManager;
        $this->refreshmentManager->loadRefreshments($this->np, $searching);
    }

    public function displayRefreshments ()
    {
        $nbp = $this->refreshmentManager->getNbPages('refreshments');
        $refreshments = $this->refreshmentManager->getRefreshments();
        require "Views/refreshments.php";
    }

    public function displayRefreshment ($id)
    {
        $refreshment = $this->refreshmentManager->getRefreshmentById($id);
        require "Views/displayRefreshment.php";
    }

    public function displayTechnicalSheet($id)
    {
        $refreshment = $this->refreshmentManager->getRefreshmentByid($id);
        require "Views/refreshmentSheet.php";
    }

    public function addRefreshment()
    {
        require "Views/addRefreshment.php";
    }

    public function addRefreshmentValidate()
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
                $this->refreshmentManager, 
                'insertRefreshmentIntoDatabase',
                'Ajout', 'Rafraîchissement', 'réalisé'
            );
        header('Location:' . URL . 'rafraîchissements');
    }

    public function deleteRrefreshment ($id)
    {
        $pictureName = $this
                ->refreshmentManager
                ->getRefreshmentByid($id)
                ->getPicture();
        if(file_exists(URL . 'img' . DIRECTORY_SEPARATOR . $pictureName)) unlink('img/'.$pictureName);
        $this->refreshmentManager->deleteRefreshmentOfDatabase($id);
        GeneralController::alertMsg('Suppression', 'Rafraîchissement', 'réalisée');
        header('Location:' . URL . 'rafraîchissements'); 
    }

    public function editRrefreshment($id)
    {
        $refreshment = $this->refreshmentManager->getRefreshmentByid($id);
        require "Views/editRefreshment.php";
    }

    public function editRrefreshmentValidate ()
    {
        $currentPicture = $this
                ->refreshmentManager
                ->getRefreshmentByid(
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
                $this->refreshmentManager, 
                'editRefreshmentIntoDatabase', 
                'Modification', 'Rafraîchissement', 
                'réalisée'
            );
        header('Location:' . URL . 'rafraîchissements'); 
    }

}