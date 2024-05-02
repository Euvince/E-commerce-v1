<?php

use HTML\Form;

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true)
{
  ob_start();

  $addThings = new Form;

  $uri = URL.'plats/mv';

  ?>
    <?= $addThings->form($uri, 'title', 'content', 'price', 'date', 'picture', 'Changez l\'image', 'text', $dish->getTitle(), $dish->getContent(), $dish->getPrice(), $dish->getCreatedAt()->format('d-F-Y | H:i:s'), $dish->getPicture(), $dish->getId()); ?>
  <?php

  $title = "Modification du Rafraîchissement : ". $dish->getId();
  $content = ob_get_clean();

  require "template.php";
}
else
{
  header('Location: ' . URL .'acceuil');
}

?>