<?php

use Controllers\CartController;
use HTML\Element;

ob_start();

if (isset($_POST['add']))
{
    CartController::ForMyCart($dish->getId(), 'dishes');
}

?>

<?= Element::displayElement($dish->getTitle(), $dish->getContent(), $dish->getPicture(), $dish->getCreatedAt()->format('d F Y H:i:s')); ?>

<?php

$content = ob_get_clean();
$title = "DETAILS DU PLAT : ". $dish->getId(). ' ' . $dish->getPrice() .'$';

require "template.php";

?>