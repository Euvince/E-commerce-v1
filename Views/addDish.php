<?php

use HTML\Form;

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true)
{
  ob_start();

  $addThings = new Form;

  $uri = URL.'plats/av';

  ?>

  <?= $addThings->form($uri, 'title', 'content', 'price', 'date', 'picture', 'Cliquez et ajouter une image', 'date'); ?>

  <?php

  $title = "Ajouter un Plat";
  $content = ob_get_clean();

  require "template.php";
}
else
{
  header('Location: ' . URL .'acceuil');
}

var_dump($_SESSION);

?>