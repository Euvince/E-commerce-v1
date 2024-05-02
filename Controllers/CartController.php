<?php

namespace Controllers;

use Models\GeneralManager;

class CartController
{

    public static function loadSessionArticles(): ?array
    {
        $generalManager = new GeneralManager();
        if (array_key_exists('cart', $_SESSION))
        {
            $melanges = [];
            foreach ($_SESSION['cart'] as $element){
                $melanges[$element['element_id']] = $element['element_table'];
            }
            /* foreach ($_SESSION['cart'] as $element){
                foreach ($element as $key => $item){
                    $melanges[$item['element_id']] = $item['element_table'];
                }
            } */
            $elements = [];
            foreach ($melanges as $key => $melange){
                $elements[] = $generalManager->loadElements($melange, 1, "", $key);
            }
            return $elements;
        }
        return null;
    }

    public function displayCart ()
    {
        $elements = self::loadSessionArticles();
        if (array_key_exists('cart', $_SESSION)){
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        require 'Views/cart.php';
    }

    public function deleteElementOfCart (int $k)
    {
        unset($_SESSION['cart'][$k]);
        header('Location:' . URL . 'pannier'); 
    }

    public static function displayFormPayment()
    {
        $total = $_POST['total'];
        require 'Views/payment.php';
    }

    public function validPaymentForm()
    {
        if(!empty($_POST) && $_POST['articles'] > 0 && $_POST['total_price'] > 0) 
        {
            $_SESSION['login-valid-form'] = $_POST['phone'];
            $response = ['success' => true];
        }
        else{$response = ['success' => false];}
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public static function ForMyCart (int $id, string $table)
    {
        if (empty($_SESSION['cart']))
        {
            $items_array = [
                "element_id"    => $id,
                "element_table" => $table,
                "element_quantity" => 1
            ];

            $_SESSION['cart'][0] = $items_array;

        }
        else 
        {
            $items_array_ids = array_column ($_SESSION['cart'], column_key: "element_id");

            if (in_array($id, $items_array_ids))
            {
                /* $_SESSION['cart'][$id]['element_quantity']++; */
                echo <<<HTML
                <style>
                    .custom-alert {
                        border-radius: 8px;
                        animation: fadeIn 0.5s;
                    }
                    @keyframes fadeIn {
                        0% {
                            opacity: 0;
                        }
                        100% {
                            opacity: 1;
                        }
                    }
                </style>
                <div class="alert alert-dismissible alert-danger custom-alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Attention!!! </strong> L'Article existe déjà dans votre panier
                </div>
HTML;
            }
            else
            {
                $count = count($_SESSION['cart']);
                $items_array = [
                    "element_id" => $id,
                    "element_table" => $table,
                    "element_quantity" => 1
                ];

                $_SESSION['cart'][$count] = $items_array;
            }
        }
    }

    public static function AlsoForMyCart (int $id)
    {
        if (empty($_COOKIE['cart']))
        {
            $items_array = [
                "element_id" => $id
            ];
            setcookie('cart', serialize($items_array), time() + 60*60*24*30);
            $_COOKIE['cart'][0] = $items_array;
        }
        else 
        {
            $items_array_ids = array_column ($_COOKIE['cart'], column_key: "element_id");

            if (in_array($id, $items_array_ids))
            {
                echo "<script>alert('Le produit existe déjà dans votre pannier')</script>";
            }
            else
            {
                $count = count($_COOKIE['cart']);
                $items_array = [
                    "element_id" => $id
                ];

                setcookie('cart', serialize($items_array), time() + 60*60*24*30);
                $_COOKIE['cart'][$count] = $items_array;
            }
        }
    }
}