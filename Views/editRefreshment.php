<?php

use HTML\Form;

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true)
{
  ob_start();

  $addThings = new Form;

  $uri = URL.'rafraîchissements/mv';

  ?>
    
    <?= $addThings->form($uri, 'title', 'content', 'price', 'date', 'picture', 'Changez l\'image', 'text', $refreshment->getTitle(), $refreshment->getContent(), $refreshment->getPrice(), $refreshment->getCreatedAt()->format('d-F-Y | H:i:s'), $refreshment->getPicture(), $refreshment->getId()); ?>
  
  <?php

  $title = "Modification du Produit : ". $refreshment->getId();
  $content = ob_get_clean();

  require "template.php";
}
else
{
  header('Location: ' . URL .'acceuil');
}

?>