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
    <div class="custom-alert alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
      <?= $_SESSION['alert']['msg']; ?>
    </div>
    
<?php 
    unset($_SESSION['alert']);
    endif; 
?>

<?php 
    if (isset ($_SESSION['admin']) && $_SESSION['admin'] === true)
    {
        $my_uri = URL.'plats/a';
        echo ' <div class="col-3">
                    <a href="'.$my_uri.'" class="btn btn-info my-4"><i class="fa-solid fa-plus"></i>Cliquer et ajouter un Plat</a>
                </div>
        ';
    }
?>

<link rel="stylesheet" href="<?= URL. 'Assets/css/paginated.css' ?>">

<div class="row" id="results">
    <?php $count = 0; for ($i = 0; $i < count($dishes); $i++): $count++; ?>
        <?= Elements::displayElements($dishes[$i], 'plats/p/', 'plats/s/', 'plats/m/', 'fiche/d/', 'plat', $count) ?>
    <?php endfor; ?>
</div>

<?php 
$title = "LES PLATS";
$content = ob_get_clean();

require "template.php";

?>