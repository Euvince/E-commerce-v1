<?php

use HTML\Elements;

ob_start(); ?>

<?php if (!empty($_SESSION['alert'])): ?>

    <style>
        .custom-alert {
            border-radius: 8px;
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
<div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
  <?= $_SESSION['alert']['msg']; ?>
</div>

<?php 
    unset($_SESSION['alert']);
    endif; 
?>

<?php 
    if (isset ($_SESSION['admin']) && $_SESSION['admin'] === true)
    {
        $my_uri = URL.'rafraîchissements/a';
        echo ' <div class="col-3">
                    <a href="'.$my_uri.'" class="btn btn-info my-4"><i class="fa-solid fa-plus"></i>Cliquer et ajouter Boisson</a>
                </div>
        ';
    }
?>

<div class="row">  
    <?php $count = 0; for ($i = 0; $i < count($refreshments); $i++):  $count++; ?>
        <?= Elements::displayElements($refreshments[$i], 'rafraîchissements/r/', 'rafraîchissements/s/', 'rafraîchissements/m/', 'fiche/r/', 'rafraîchissement', $count) ?>
    <?php endfor; ?>
</div>

<?php

$title = "LES RAFRAICHISSEMENTS";
$content = ob_get_clean();

require "template.php";

?>