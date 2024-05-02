<?php

namespace HTML;

class Sheet 
{
    public static function dispalySheet(
        string $picture, 
        string $guarantee,
        string $features,
        string $specifications,
        string $customizations,
        string $generalities,
        int $price): string
    {
        $img_uri = URL .'img/img1.svg';
        $disabled = array_key_exists('user', $_SESSION) ? 'disabled' : '';
        $sheet = <<<HTML
        <div class="row">
            <div class="col">
                <img src="{$picture}" style="width:600px; height: 415px;" alt="">
            </div>
            <div class="col">
                <input type="button" class="btn btn-primary btn-sm" style="border-radius: 5px; width: 110px;" value="Avec bijou">
                <div class="row mt-2">
                    <h3 class="font-weight-bold"><strong>COFFRET LE CURIEUX - MONOI</strong></h3>
                </div>
                <div class="row">
                    <div class="col">
                        <p><strong style="font-weight: bold;">44.90$</strong> <span style="color: #E0E0E0;">|</span> <span>70h </span> <i></i></p>
                    </div>
                    <div class="col offset-3">
                        <i class="fa-solid fa-star" style="color: #FFCDD2;"></i> <i class="fa-solid fa-star" style="color: #FFCDD2;"></i> <i class="fa-solid fa-star" style="color: #FFCDD2;"></i> <i class="fa-solid fa-star" style="color: #FFCDD2;"></i> <i class="fa-solid fa-star" style="color: #FFCDD2;"></i> 21Avis
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">Le bijou de l'édition</div>
                    <div class="col offset-3">Bracelet Argent</div>
                </div>
                <hr>
                <div class="row">
                    <p>Complétez votre coffret avec ...</p>
                    <div class="col d-flex">
                        <img class="mt-3" src="{$img_uri}" style="width:80px; height:70px;" alt="">
                        <div class="mx-3" style="display: flex; flex-direction: column;">
                            <span>Allumettes XXL</span>
                            <span class="mt-1">+4.90$</span>
                            <div class="mt-2"><i class="fa-solid fa-download" style="color: #FFCDD2; cursor: pointer;"></i><span class="mt-2" href="" style="text-decoration: underlined; color: #FFCDD2; font-weight: bold; font-size: 18px;">Télécharger</span></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">

                    </div> 

                </div>
                <div class="row mt-4">
                    <form action="" method="POST" style="display: flex;">
                        <div class="col-9"><button type="submit" name="add" class="btn btn-primary {$disabled}" style="width: 460px;background: #FFCDD2; border-radius: 4px;">Ajouter au pannier | <span>{$price}$</span></button></div>
                        <div class="col"><i class="fa-regular fa-heart" style="cursor: pointer; width: 50px; border-radius: 4px; border: 1px solid #E0E0E0; margin-left: 5px;  padding: 15px;"></i></div>
                        <div class="col"><i class="fa-solid fa-download" style="cursor: pointer; width: 50px; border-radius: 4px; border: 1px solid #E0E0E0; margin-right: 5px;  padding: 15px;"></i></div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col"><strong>Garantie</strong></th>
                <th scope="col"><strong>Fonctionnalités</strong></th>
                <th scope="col"><strong>Spécifications</strong></th>
                <th scope="col"><strong>Personnalisations</strong></th>
                <th scope="col"><strong>Généralités et Principes</strong></th> 
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">$guarantee</th>
                    <th scope="col">$features</th>
                    <th scope="col">$specifications</th>
                    <th scope="col">$customizations</th>
                    <th scope="col">$generalities</th>
                </tr>
            </tbody>
        </table>
HTML;
        return $sheet;
    }
}