<?php

require "vendor/autoload.php";

session_start();

use Controllers\AdminController;
use Controllers\CartController;
use Controllers\DishController;
use Controllers\DompdfController;
use Controllers\Html2pdfController;
use Controllers\ProductController;
use Controllers\RefreshmentController;
use Controllers\SheetController;
use Controllers\StatisticsController;
use Controllers\UserController;
use HTML\Estimate;

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http"). "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

$dishController = new DishController(1);
$productController = new ProductController(1);
$refreshmentController = new RefreshmentController(1);
$adminController = new AdminController;
$cartController = new CartController;
$userController = new UserController;
$sheetController = new SheetController;
$statisticsController = new StatisticsController;

setlocale(LC_ALL, 'fr_FR.utf8');
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

if (empty($_GET['page']))
{
    require "Views/acceuil.php";
}
else
{
    $url = explode ( "/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
    try
    {
        switch ($url[0])
        {
            case "acceuil" : 
                if (empty($url[1]))
                {
                    require "Views/acceuil.php";
                }
            break;

            case "plats" :
                if (empty($url[1]))
                {
                    $dishController->displayDishes();
                }
                else if ($url[1] === "p")
                {
                    $dishController->displayDish($url[2]);
                }
                else if ($url[1] === "a")
                {
                    $dishController->addDish();
                }
                else if ($url[1] === "av")
                {
                    $dishController->addDishValidate();
                }
                else if ($url[1] === "s")
                {
                    $dishController->deleteDish($url[2]);
                }
                else if ($url[1] === "m")
                {
                    $dishController->editDish($url[2]);
                }
                else if ($url[1] === "mv")
                {
                    $dishController->editDishValidate();
                }
                else 
                {
                    throw new Exception("CETTE PAGE N'EXISTE PAS !");
                }
            break;

            case "produits" : 
                if (empty($url[1]))
                {
                    $productController->displayProducts();
                }
                else if ($url[1] === "p")
                {
                    $productController->displayProduct($url[2]);
                }
                else if ($url[1] === "a")
                {
                    $productController->addProduct();
                }
                else if ($url[1] === "av")
                {
                    $productController->addProductValidate();
                }
                else if ($url[1] === "s")
                {
                    $productController->deleteProduct($url[2]);
                }
                else if ($url[1] === "m")
                {
                    $productController->editProduct($url[2]);
                }
                else if ($url[1] === "mv")
                {
                    $productController->editProductValidate();
                }
                else 
                {
                    throw new Exception("CETTE PAGE N'EXISTE PAS !");
                }
            break;

            case "rafraîchissements" : 
                if (empty($url[1]))
                {
                    $refreshmentController->displayRefreshments();
                }
                else if ($url[1] === "r")
                {
                    $refreshmentController->displayRefreshment($url[2]);
                }
                else if ($url[1] === "a")
                {
                    $refreshmentController->addRefreshment();
                }
                else if ($url[1] === "av")
                {
                    $refreshmentController->addRefreshmentValidate();
                }
                else if ($url[1] === "s")
                {
                    $refreshmentController->deleteRrefreshment($url[2]);
                }
                else if ($url[1] === "m")
                {
                    $refreshmentController->editRrefreshment($url[2]);
                }
                else if ($url[1] === "mv")
                {
                    $refreshmentController->editRrefreshmentValidate();
                }
                else 
                {
                    throw new Exception("CETTE PAGE N'EXISTE PAS !");
                }
            break;
            case "utilisateurs" :
                if (empty($url[1]))
                {
                    $userController->displayUsers();
                }
                else if ($url[1] === "av")
                {
                    $userController->addUserValidate();
                }
                else if ($url[1] === "m")
                {
                    $userController->editUser($url[2]);
                }
                else if ($url[1] === "mv")
                {
                    $userController->editUserValidate();
                }
                else if ($url[1] === "s")
                {
                    $userController->deleteUser($url[2]);
                }
                else 
                {
                    throw new Exception("CETTE PAGE N'EXISTE PAS !");
                }
            break;

            case "administration" :
                if (empty($url[1]))
                {
                    $adminController->adminAuth();
                }
                else if ($url[1] === "av")
                {   
                    $adminController->is_admin();
                }
                else 
                {
                    throw new Exception("CETTE PAGE N'EXISTE PAS !");
                }
            break;

            case "login" :
                if (empty($url[1]))
                {
                    $userController->ul();
                }
                else if ($url[1] === "ulv")
                {
                    $userController->login();
                }
                else 
                {
                    throw new Exception("CETTE PAGE N'EXISTE PAS !");
                }
            break;

            case "register" :
                if (empty($url[1]))
                {
                    $userController->ur();
                }
                else if ($url[1] === "urv")
                {
                    $userController->register();
                }
                else 
                {
                    throw new Exception("CETTE PAGE N'EXISTE PAS !");
                }
            break;
            case "logout" :
                if (empty($url[1]))
                {
                    $adminController->logout();
                }
                else 
                {
                    throw new Exception("CETTE PAGE N'EXISTE PAS !");
                }
            break;

            case "statistiques" :
                if (empty($url[1]))
                {
                    $statisticsController->showStatistics();
                }
                else 
                {
                    throw new Exception("CETTE PAGE N'EXISTE PAS !");
                }
            break;

            case "pannier" :
                if (empty($url[1]))
                {
                    $cartController->displayCart();
                }
                else if ($url[1] === 's')
                {
                    $cartController->deleteElementOfCart($url[2]);
                }
                else if ($url[1] === 'vf')
                {
                    $cartController->validPaymentForm();
                }
                else 
                {
                    throw new Exception("CETTE PAGE N'EXISTE PAS !");
                }
            break;

            case "estimate" :
                if (empty($url[1]))
                {
                    Html2pdfController::generatePDF(Estimate::displayEstimate());
                }
            break;

            case "fiche" :
                if (empty($url[1]))
                {
                    throw new Exception("CETTE PAGE N'EXISTE PAS !");
                }
                else if ($url[1] === 'd')
                {
                    $dishController->displayTechnicalSheet($url[2]);
                }
                else if ($url[1] === 'p')
                {
                    $productController->displayTechnicalSheet($url[2]);
                }
                else if ($url[1] === 'r')
                {
                    $refreshmentController->displayTechnicalSheet($url[2]);
                }
            break;
            default : throw new Exception("CETTE PAGE N'EXISTE PAS !");
        }
    }
    catch (Exception $e)
    {
        $msg = $e->getMessage();
        require "Views/errors.view.php";
    }
}