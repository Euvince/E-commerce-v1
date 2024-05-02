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
    <title>Inscrivez-Vous</title>

    <link rel="stylesheet" href="<?= URL ?>Assets/css/styles.css">
</head>
<body>
    <div class="Ensemble">
        <header>
            <div class="top">
                 <div class="details">
                <h3>Innover pour servir</h3>
            </div>
            <a href="<?= URL ?>acceuil" type="submit" class="quitter">Quitter</a>
            </div>
            <h6>Veuilez suivre les différentes étapes et vos informations nous parviendront</h6>
         </header>
         <section class="s_inscription">
           <form class="inscription" method="POST" name="formulaire" id="formulaire" enctype="multipart/form-data">
                <div class="errors"></div>
                <div class="champs">
                    <input type="text" class="textType" data-qv-rules="required|startWithLetter|between:2,80|only:string" placeholder="Entrer le Nom d'Utilisateur" name="username" id="username" required>
                    <div data-qv-feedback="username"></div>
                    <div class="username-exist"></div>
                    <input type="text" class="textType" data-qv-rules="required|email|minlength:15|maxlength:32" placeholder="Entrer le Mail" name="mail" id="mail" required>
                    <div data-qv-feedback="mail"></div>
                    <div class="mail-exist"></div>
                    <input type="password" class="textType" data-qv-rules="required|password" placeholder="Entrer le Mot de Passe" name="password" id="password" required>
                    <div data-qv-feedback="password"></div>
                    <input type="file" id="picture" data-qv-rules="required|file|maxFileSize:1MB"  class="textType" name="picture" required>
                    <div data-qv-feedback="picture"></div>
                </div>
                <div class="avant-btns"> 
                    <div class="rappelI">
                        <input type="checkbox" class="Cocher">
                        <h6>Je comprends et j'accepte les conditions</h6>
                    </div>
                    <h6 class="mp">Mot de passe oublié ?</h6>
                </div>
                <div class="buttons">
                    <button class="SeConnecter" type="submit" name="BtnOne">S'inscrire</button>
                    <a href="<?= URL ?>login" class="Sinscrire">Connectez-Vous</a>
                </div>
           </form>
         </section>
    </div>
    <script src="Assets/js/quickv.js"></script>
   <script>

        const qv = new Quickv();
        qv.init();

        var username = document.querySelector('#username');
        var mail = document.querySelector('#mail');
        var password = document.querySelector('#password');
        var file = document.querySelector('#picture');
        var errors = document.querySelector('.errors');
        var formulaire = document.querySelector('#formulaire');
        var error_mail = document.querySelector('.mail-exist');
        var error_username = document.querySelector('.username-exist');
        var errors_msg = document.createElement('p');
        var error_msg01 = document.createElement('p');
        var error_msg02 = document.createElement('p');
        errors_msg.textContent = "Veuillez bien remplir tous les champs du formulaire !";
        error_msg01.textContent = "L'email existe déjà !";
        error_msg02.textContent = "Le nom d'utilisateur existe déjà !";

        formulaire.addEventListener('submit',function(e){
            e.preventDefault();

            const myFile = new FormData();

            myFile.append("picture" , file.files[0]); 
            myFile.append("username", username.value);
            myFile.append("mail", mail.value);
            myFile.append("password", password.value);

            if(username.value === "" || mail.value === "" || password.value === "" || picture.value === "") errors.appendChild(errors_msg);

            fetch('http://localhost/GESTION%20MVC%202.0/register/urv',{
                method:"POST",
                body: myFile
            }) 
            .then(response => response.json())
            .then(
                response =>  {
                    if(response.success01){
                        console.log(response); 
                        error_mail.appendChild(error_msg01);
                    }
                    else 
                    {
                        if(username.value !== "" && mail.value !== "" && password.value !== "" && picture.value !== "")
                        window.location.href="login";
                    }
            })
            .catch(error => {
                console.error(error);
            });
        });
</script>
</body>
</html>