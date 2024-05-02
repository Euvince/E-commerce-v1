<?php

use HTML\Form;

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true)
{
  ob_start();

  $addThings = new Form;

  $uri = URL.'produits/mv';

  ?>

    <?= $addThings->form($uri, 'title', 'content', 'price', 'date', 'picture', 'Changez l\'image', 'text', $product->getTitle(), $product->getContent(), $product->getPrice(), $product->getCreatedAt()->format('d-F-Y | H:i:s'), $product->getPicture(), $product->getId()); ?>

  <?php

  $title = "Modification du Produit : ". $product->getId();
  $content = ob_get_clean();

  require "template.php";
}
else
{
  header('Location: ' . URL .'acceuil');
}

?>