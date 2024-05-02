<?php 

if (array_key_exists('user', $_SESSION)) header('Location: ' . URL .'acceuil'); 

if (!array_key_exists('login-valid-form', $_SESSION)) header('Location: ' . URL .'acceuil'); 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectez-Vous</title>

    <link rel="stylesheet" href="<?= URL ?>Assets/css/styles.css">
</head>
<body>
    <div class="Ensemble">
        <header>
            <div class="top">
                 <div class="details">
                <i></i>
                <h3>Innover pour servir</h3>
            </div>
            <a href="<?= URL ?>acceuil" type="submit" class="quitter">Quitter</a>
            </div>
            <h6>Suivez les étapes et remplissez les champs pour valider votre commande</h6>
         </header>
         <section>
           <form action="" method="POST" class="connexion">
                <div class="errors"></div>
                <div class="email">
                    <input type="text" class="textType" data-qv-rules="required" placeholder="Entrer le Mail" name="mail" id="mail" required>
                    <div data-qv-feedback="mail"></div>
                    <div class="mail-exist"></div>
                </div>
                <div class="password">
                    <input type="password" class="textType" data-qv-rules="required" placeholder="Entrer le Mot de Passe" name="password" id="password" required>
                    <div data-qv-feedback="password"></div>
                    <div class="password-exist"></div>
                </div>
                <div class="avant-btns">
                    <div class="rappelC">
                        <input type="checkbox" class="Cocher">
                        <h6>Se souvenir</h6>
                    </div>
                    <h6 class="mp">Mot de passe oublié ?</h6>
                </div>
                <div class="buttons">
                    <button class="SeConnecter" type="submit" name="BtnThree">Se connecter</button>
                    <a href="<?= URL ?>register"  class="Sinscrire">Créer Compte</a>
                </div>
           </form>

         </section>
    </div>

    <script src="Assets/js/quickv.js"></script>
   <script>

        const qv = new Quickv();
        qv.init();

        var mail = document.querySelector('#mail');
        var password = document.querySelector('#password');
        var connexion = document.querySelector('.connexion');
        var errors = document.querySelector('.errors');
        var error_mail = document.querySelector('.mail-exist');
        var error_password = document.querySelector('.password-exist');
        var errors_msg = document.createElement('p');
        var empty_msg = document.createElement('p');
        var error_msg01 = document.createElement('p');
        var error_msg02 = document.createElement('p');
        empty_msg.textContent = "Veuillez bien remplir tous les champs du formulaire !";
        errors_msg.textContent = "Email ou Mot de passe incorrects";
        error_msg01.textContent = "L'utilisateur n'existe pas !";
        error_msg02.textContent = "Le mot de passe est erroné !";

        connexion.addEventListener('submit',function(e){
            e.preventDefault();

            const myFile = new FormData();

            myFile.append("mail", mail.value);
            myFile.append("password", password.value);

            if(mail.value === "" || password.value === "") errors.appendChild(empty_msg);

            fetch('http://localhost/GESTION%20MVC%202.0/login/ulv',{
                method:"POST",
                body: myFile
            }) 
            .then(response => response.json())
            .then(
                response =>  {
                    if(response.success)
                    {
                        console.log(response);
                        window.location.href="acceuil";
                    }
                    else 
                    {
                        console.log(response);
                        errors.appendChild(errors_msg);
                    }
            })
            .catch(error => {
                console.error(error);
            });
        })

    </script>
</body>
</html>