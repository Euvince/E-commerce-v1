<?php

namespace HTML;

use Controllers\GeneralController;

class Element 
{
    public static function displayElement (string $methodOne, string $methodTwo, string $methodThree, $methodFour): string
    {
        $h = URL. 'img/';
        $uri = $methodThree;
        $uri2 = URL. 'pannier';
        $g = new GeneralController();
        $disabled = array_key_exists('user', $_SESSION) ? 'disabled' : '';
        return <<<HTML
        <form action="" method="POST">
            <div class="row">
                <div class="col-6">
                    <img src="{$uri}" style="width:580px; height:445px" alt="">
                </div>
                <div class="col-6">
                    <h2>{$methodOne}</h2>
                    <p>{$g::Excerpt($methodTwo, 635)}</p>
                    <div class="col my-3">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <div class="date mt-4">$methodFour</div>
                    <button name="add" type="submit" id="" class="btn btn-primary {$disabled} my-5"><i class="fa-solid fa-plus"></i>Ajouter au pannier<i class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </div>
        </form>
HTML;
    }
}