<?php

namespace HTML;

class UserForm 
{

    public static function returnFormForUser (
        string $btnValue,
        string $btnCss,
        string $goTo,
        ?string $nameValue = null, 
        ?string $mailValue = null, 
        ?string $passwordValue = null, 
        ?string $userPicture = null,
        ?string $hiddenInputValue = null
    ): string
    {
        $uri = $userPicture;
        $userPictureView = "";
        if (isset($userPicture)):
            $userPictureView .= <<<HTML
            <h5 class="">Image : </h5>
            <img class="" src="{$uri}" style="width: 500px; height: 400px; border-radius:15px;">
HTML;
        endif;
        $hiddenInput = "";
        if (isset($hiddenInputValue)):

            $hiddenInput .= <<<HTML
            <input type="hidden" id="user_id" name="user_id" value="{$hiddenInputValue}">
HTML;
        endif;

        return <<<HTML
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
                <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
                <style>
                    .gauche , .droit{
                        padding: 0px 0px;
                    }
                    .gauche img{
                        width: 100%;
                        height: 100vh;
                    }
                    div.mt-4{
                        width: 55%;
                        margin: 0% 22.5%;
                    }
                    .text{
                        text-align: center;
                        color: black;
                        font-size: 19px;
                        font-weight: bold;
                    }
                    .connexion{
                        text-align: center;
                        margin-top: 2%;
                        font-size: 18px;
                    }

                </style>

            </head>
            <body>
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-7">
                            <p class="text animate__animated animate__bounceInDown"><strong>Ajouter un nouvel Utilisateur au système</strong></p>
                            <form action="{$goTo}" method="POST" id="formulaire" enctype="multipart/form-data">
                                <div class="mt-4">
                                    <input type="text" id="name" class="form-control animate__animated animate__bounceInDown"  data-qv-rules="required|startWithLetter|between:2,80|only:string" placeholder="Nom" name="name" value="{$nameValue}" required>
                                    <div data-qv-feedback="name" style="color: red; font-size: 15px;"></div>
                                </div>
                                <div class="mt-4">
                                    <input type="text" id="email" class="form-control animate__animated animate__bounceInDown" data-qv-rules="required|email|minlength:15|maxlength:32" placeholder="Email" value="{$mailValue}" name="mail" required>
                                    <div data-qv-feedback="mail" style="color: red; font-size: 15px;"></div>
                                </div>
                                <div class="mt-4">
                                    <input type="password" id="mot_de_passe" class="form-control animate__animated animate__bounceInDown" data-qv-rules="required|password" placeholder="Mot de passe" value="{$passwordValue}" name="password" required>
                                    <div data-qv-feedback="password" style="color: red; font-size: 15px;"></div>
                                </div>
                                <div class="mt-4">
                                    <input type="file" id="photo" class="form-control animate__animated animate__bounceInDown" data-qv-rules="required|file|maxFileSize:1MB" placeholder="Photo de Profil" name="picture">
                                    <div data-qv-feedback="picture" style="color: red; font-size: 15px;"></div>
                                </div>
                                {$hiddenInput}
                                <div class="button">
                                    <input type="submit" id="submit" data-qv-submit style="{$btnCss}" class="btn btn-primary mt-4 animate__animated animate__bounceInDown" value="{$btnValue}" name="ajouter">
                                </div>
                            </form>
                            <p class="connexion animate__animated animate__bounceInDown">Vous avez fini de remplir ? Soumettez-les.</span></p>
                        </div>
                        <div class="col-md-5">{$userPictureView}</div>
                    </div>
                </div>

                <script src="Assets/js/quickv.js"></script>
                <script>
                    const qv = new Quickv();
                    qv.init();
                </script>
                <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
            </body>
            </html>
HTML;
    }
}