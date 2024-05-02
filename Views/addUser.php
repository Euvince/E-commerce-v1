<?php

use HTML\UserForm;

$uri = URL.'utilisateurs/av';

echo UserForm::returnFormForUser(
    "Soumettre","margin: 0% 42%;",
    $uri
);

?>