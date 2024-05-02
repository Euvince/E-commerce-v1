<?php

use Controllers\UserController;

if (isset ($_SESSION['admin']) && $_SESSION['admin'] === true)
{
  ob_start();
  
  if (isset($_POST['new']))
  {
    UserController::addUser();
  }
  
  ?>
  
  <?php if (!empty($_SESSION['alert'])): ?>
  
  <div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
    <?= $_SESSION['alert']['msg']; ?>
  </div>
  
  <?php 
  unset($_SESSION['alert']);
  endif; 
  ?>
  
  <div class="row mb-3">
    <div class="col offset-8">
      <form action="" method="POST">
        <button href="" class="btn btn-info" style="margin-left: 56px;" name="new"><i class="fas fa-plus-circle mx-1"></i>Un Nouvel Utilisateur</button>
      </form>
    </div>
  </div>
  
  <table class="table table-hover table-striped">
    <thead>
      <tr>
        <th scope="col">Profil</th>
        <th scope="col"><strong>Username</strong></th>
        <th scope="col"><strong>Email</strong></th>
        <th scope="col"><strong>Password</strong></th>
        <th scope="col"><strong>Actions de Maintenances</strong></th> 
      </tr>
    </thead>
    <tbody>
        <?php 
            $count = 0; for($i = 0; 
            $i < count($users); $i++): $count++; 
            $img = $users[$i]->getPicture(); 
            $user_img = file_exists('img/' . $img) ? 'img/' . $img : $img; 
          ?>
          <tr class="">
            <td scope="col"><img src="<?= $user_img; ?>" style="height:40px;width: 50px; border-radius:50%;cursor:pointer"></td>
            <th scope="col" style="cursor:pointer"><?= UserController::Excerpt($users[$i]->getUsername()); ?></th>
            <th scope="col"><?= UserController::Excerpt($users[$i]->getMail()); ?></th>
            <th scope="col"><?= UserController::Excerpt($users[$i]->getPassword()); ?></th>
            <th scope="col">
              <a href="<?= URL ?>utilisateurs/m/<?= $users[$i]->getId(); ?>" class="btn btn-warning btn-sm">Modification</a>
              <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUser<?= $count ?>">Suppression</a>
            </th>
          </tr>
  
          <div class="modal fade" id="deleteUser<?= $count ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer cet Utilisateur?</p>
                </div>
                <div class="modal-footer">
                    <a href="<?= URL ?>utilisateurs/s/<?= $users[$i]->getId(); ?>" type="button" class="btn btn-primary">Save changes</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
          </div>
        <?php endfor; ?>
    </tbody>
  </table>
  
  <?php
  
  $title = "LES UTILISATEURS";
  $content = ob_get_clean();
  
  require "template.php";
}

else 
{
  header('Location: ' . URL .'acceuil');
}

?>