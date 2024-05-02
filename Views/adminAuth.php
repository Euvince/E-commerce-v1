<?php

if (array_key_exists('user', $_SESSION) || array_key_exists('login-form-valid', $_SESSION) ) header('Location: ' . URL .'acceuil'); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectez-Vous</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Assets/css/adminAuth.css">
</head>
<body>
    <div class="Ensemble">
        <header>
            <div class="top">
                 <div class="details">
                <i></i>
                <h3>Innover pour servir</h3>
            </div>
            <button type="submit">Quitter</button>
            </div>
            <h6>Veuilez suivre les différentes étapes et vos informations nous parviendront</h6>
         </header>
         <section>
           <form action="<?= URL ?>administration/av" method="POST" class="connexion">
                <div class="email">
                    <i></i>
                    <input type="text" class="textType" placeholder="Entrer le Mail" name="email">
                </div>
                <div class="password">
                    <i></i>
                    <input type="password" class="textType" placeholder="Entrez le Mot de Passe" name="password">
                </div>
                <div>
                    <div class="rappelC">
                        <input type="checkbox" class="Cocher">
                        <h6>Se souvenir</h6>
                    </div>
                    <h6 class="mp">Mot de passe oublié ?</h6>
                </div>
                <div class="buttons">
                    <button class="SeConnecter" name="BtnThree">Se connecter</button>
                </div>
           </form>

         </section>
    </div>
</body>
</html>