<?php

use HTML\Form;

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true)
{
  ob_start();

  $addThings = new Form;

  $uri = URL.'produits/av';

  ?>
    
    <?= $addThings->form($uri, 'title', 'content', 'price', 'date', 'picture', 'Cliquez et ajouter une image', 'date'); ?>

  <?php

  $title = "Ajouter un Produit";
  $content = ob_get_clean();

  require "template.php";
}
else
{
  header('Location: ' . URL .'acceuil');
}

?>