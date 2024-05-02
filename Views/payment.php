<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>FORMULAIRE</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <style>
        .gauche , .droit{
            padding: 0px 0px;
        }
        .gauche img{
            width: 100%;
            height: 100vh;
        }
        .btn-outline{
            background: white;
            color: #e9c384;
            border: 2px solid #e9c384;
            margin: 0% 42%;
        }
        div.mt-4{
            width: 55%;
            margin: 0% 22.5%;
        }
        .btn-outline:hover{
            background-color: #e9c384;
            color: white;
        }
        h1{
            color: #e9c384;
            text-align: center;
            margin-top: 7%;
        }
        .text{
            text-align: center;
            color: #e9c384;
            opacity: 0.7;
        }
        .connexion{
            text-align: center;
            margin-top: 2%;
        }
        span a{
            color: #e9c384;
            text-decoration: none;
        }
        span a:hover{
            color: #e9c384;
        }

    </style>


  </head>
  <body>
    <div class="container-fluid">

            <div class="col-md-7">
                <h1 class="animate__animated animate__bounceInDown">Valider Commande</h1>
                <p class="text animate__animated animate__bounceInDown">Remplissez les Informations</p>
                <form action="" method="post" id="formulaire">
                    <div class="mt-4">
                        <p class="animate__animated animate__bounceInDown">Nombre d'Articles</p>
                        <input id="number" name="number" class="form-control animate__animated animate__bounceInDown" value="<?= array_key_exists('cart', $_SESSION) ? count($_SESSION['cart']) : 0; ?>" readonly required>
                        <div data-qv-feedback="number" style="color: red; font-size: 15px;"></div>
                    </div>
                    <div class="mt-4">
                        <p class="animate__animated animate__bounceInDown">Prix Total</p>
                        <input id="pt" name="pt" class="form-control animate__animated animate__bounceInDown" value="<?= $total ?? 0 ?>$" readonly required>
                        <div data-qv-feedback="pt" style="color: red; font-size: 15px;"></div>
                    </div>
                    <div class="mt-4">
                        <p class="animate__animated animate__bounceInDown">Numéro de Téléphone</p>
                        <input type="text" data-qv-rules="required|phone" id="your-number" placeholder="+229 96909016" name="telephone" class="form-control animate__animated animate__bounceInDown" required>
                        <div data-qv-feedback="telephone" style="color: red; font-size: 15px;"></div>
                    </div>
                    <div class="mt-4">
                        <p class="animate__animated animate__bounceInDown">Moyen de Paiement</p>
                        <select name="" class="form-control animate__animated animate__bounceInDown">
                            <option value="Mobile-Money" id="mp">Mobile-Money</option>
                        </select>
                    </div>
                    <form action="">
                        <div class="button">
                            <input type="submit" id="submit" class="btn btn-outline mt-4 animate__animated animate__bounceInDown" value="Soumettre" data-qv-submit>
                        </div>
                    </form>
                </form>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="Assets/js/quickv.js"></script>
    <script>

        const qv = new Quickv();
        qv.init();

        var number = $('#number');
        var pt = $('#pt');
        var mail = $('#mail');
        var ynumber = $('#your-number');
        var mp = $('#mp');
        var submit = $('#submit');

        var formulaire = $('#formulaire');

        formulaire.submit(function(e){
            e.preventDefault();
            console.log(e)

            if(ynumber.val()==''){
                swal("Veuillez completer votre numéro de téléphone",{
                icon: "error",
                });
            }
            if(number.val() <= 0){
                swal("Veuillez ajouter des éléments à votre panier",{
                icon: "error",
                });
            }
            if(pt.val() <= 0){
                swal("Veuillez ajouter des éléments à votre panier",{
                icon: "error",
                });
            }
            else{

                const data = new FormData();

                data.append("articles", number.val());
                data.append("total_price", pt.val());
                data.append("phone", ynumber.val());
                data.append("payment_mode", mp.val());

                fetch('http://localhost/GESTION%20MVC%202.0/pannier/vf', {
                    method : "POST",
                    body: data
                })
                .then((response) => response.json())
                .then((response) => {
                    if(response.success /*  === true && number.val() > 0 && pt.val() > 0 && ynumber.val() !== '' */)
                    {
                        window.location.href="http://localhost/GESTION%20MVC%202.0/login";
                    }
                })
                .catch((err) => {
                    console.error(err) 
                });
            }
        })

    </script>
  </body>
</html>