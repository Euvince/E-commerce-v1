<?php

ob_start();

?>

<?php

if (isset($is_admin) && $is_admin === true){
    $_SESSION['admin'] = $is_admin;
}

?>

<?php 

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true)
{
    echo "ICI LA PAGE D'ACCEUIL POUR L'ADMINISTRATION <br>
    NOUS VOUS PRIONS D'EFFECTUER VOTRE PARCOURS ET D'EFFECTUER VOS CHANGEMENTS EN TOUTE SÉCURITÉ";
}
else 
{
    echo "ICI LA PAGE D'ACCEUIL <br>
    NOUS VOUS PRIONS D'EFFECTUER VOTRE PARCOURS ET D'EFFECTUER VOS CHOIX EN TOUTE SÉRÉNITÉ";
}

?>

<?php 

$title = ((isset($_SESSION['admin']) && $_SESSION['admin'] === true) ? "BIENVENUE SUR VOTRE DASHBOARD" : "BIENVENUE");
$content = ob_get_clean();

require "template.php";

?>