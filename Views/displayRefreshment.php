<?php

use Controllers\CartController;
use HTML\Element;

ob_start();

if (isset($_POST['add']))
{
    CartController::ForMyCart($refreshment->getId(), 'refreshments');
}

?>

<?= Element::displayElement($refreshment->getTitle(), $refreshment->getContent(), $refreshment->getPicture(), $refreshment->getCreatedAt()->format('d F Y H:i:s')); ?>

<?php

$content = ob_get_clean();
$title = "DETAILS DU RAFRAICHISSEMENT : ". $refreshment->getId(). ' ' . $refreshment->getPrice() .'$';

require "template.php";

?>