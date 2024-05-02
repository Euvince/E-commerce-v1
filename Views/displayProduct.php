<?php

use Controllers\CartController;
use HTML\Element;

ob_start();

if (isset($_POST['add']))
{
    CartController::ForMyCart($product->getId(), 'products');
}

?>

<?= Element::displayElement($product->getTitle(), $product->getContent(), $product->getPicture(), $product->getCreatedAt()->format('d F Y H:i:s')); ?>

<?php

$content = ob_get_clean();
$title = "DETAILS DU PRODUIT : ". $product->getId(). ' ' . $product->getPrice() .'$';

require "template.php";

?>