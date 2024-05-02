<?php

use Controllers\CartController;
use HTML\Sheet;


ob_start();

$faker = Faker\Factory::create('fr', 'FR');

$guarantees = ['Remboursement','Qualité', 'Échange', 'Satisfaction'];

$sheet =  Sheet::dispalySheet(
        $dish->getPicture(), 
        'Nous vous offrons en Garantie : <br>'.$faker->randomElement($guarantees).'-'.$faker->numberBetween(1, 10).'mois', 
        $faker->paragraphs(1, 3), 
        $faker->paragraphs(1, 3), 
        $faker->paragraphs(1,3), 
        $faker->paragraphs(1, 3),
        $dish->getPrice()
    );

if (isset($_POST['add']))
{
    CartController::ForMyCart($dish->getId(), 'dishes');
}

?>

<?= $sheet; ?>

<?php
$title = "Explorer la Fiche Technique";
$content = ob_get_clean();
require "template.php";

?>