<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Mon Site'  ?></title>

    <!-- <link rel="stylesheet" href="<?= URL ?>bootstrap-5.1.3-dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>acceuil">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>produits">Produits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>plats">Plats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>rafraîchissements">Rafraîchissements</a>
        </li>
        <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>utilisateurs">Utilisateurs</a>
          </li>
        <?php endif;  ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu">
            <?php if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true): ?>
              <a class="dropdown-item" href="<?= URL ?>pannier"><i class="fa-solid fa-eye mx-2"></i>Mon pannier 
                <?php if(array_key_exists('cart', $_SESSION) && count($_SESSION['cart']) >= 1): ?>
                  <small class="mx-1" style="background: black; color:white; border-radius: 30px;padding:3px;"><?= (count($_SESSION['cart']) < 10) ? 0 : "" ?><?= count($_SESSION['cart']) ?? "" ?></small>
                <?php endif; ?>
            </a>
            <?php endif;  ?>
            <?php if(!empty($_SESSION['user']) && !empty($_SESSION['login-valid-form'])): ?>
              <a class="dropdown-item" href="<?= URL ?>estimate"><i class="fa-solid fa-download mx-2"></i>Mon Devis</a>
            <?php endif;  ?>
            <?php if((isset($_SESSION['admin']) && $_SESSION['admin'] === true)): ?>
              <a class="dropdown-item" href="<?= URL ?>statistiques"><i class="fa-solid fa-chart-simple mx-2"></i>Statistiques</a>
            <?php endif;  ?>
            <?php if((isset($_SESSION['admin']) && $_SESSION['admin'] === true) || !empty($_SESSION['user'])): ?>
              <a class="dropdown-item" href="<?= URL ?>logout"><i class="fa-solid fa-right-from-bracket mx-2"></i>Déconnexion</a>
            <?php endif;  ?>
          </div>
        </li>
      </ul>
      <form action="" method="POST" class="d-flex">
        <input class="form-control me-sm-2" type="search" id="search" placeholder="Entrez votre recherche" name="searching">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="search">Rechercher</button>
      </form>
    </div>
  </div>
</nav>
    
    <div class="container my-3"> 
            <h1 class="rounded  p-2 m-2 text-center text-white bg-dark"> <?= isset($title) ? $title : 'Bienvenue';  ?> </h1>
            <div class="body my-5 mx-3">
              <?= isset ($content) ? $content : 'Mon Contenu'; ?>
            </div>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- <script src="<?= URL ?>bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script> -->

</body>
</html>