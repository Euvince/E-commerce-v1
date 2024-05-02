<?php

use HTML\UserForm;

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true)
{
    ob_start();
    ?>

    <?php

    $uri = URL.'utilisateurs/mv';

    echo UserForm::
        returnFormForUser(
            'Soumettre les modifications','margin: 0% 30%;',
            $uri,
            $user->getUsername(), 
            $user->getMail(), 
            $user->getPassword(), 
            $user->getPicture(),
            $user->getId()
        );

    ?>

    <?php

    $title = "Modification de l'Utilisateur : ". $user->getId();
    $content = ob_get_clean();

    require "template.php";

}
else
{
  header('Location: ' . URL .'acceuil');
}

?>
