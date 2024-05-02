<?php

use Controllers\CartController;
use Controllers\GeneralController;

ob_start();

$total = 0;

if (array_key_exists('admin', $_SESSION)) header('Location: ' . URL .'acceuil'); 

if(isset($_POST['add'])) CartController::displayFormPayment();

?>

<div class="container bg-light py-3 my-5">
    <div class="row">
        <div class="col-7">
            <?php if (array_key_exists('cart', $_SESSION)): ?>
                <?php $count = 0; foreach ($elements as $key => $element): $count++;
                    $total += $element['price'];
                    $disabled = array_key_exists('user', $_SESSION) ? 'disabled' : '';
                ?>
                    <div class="row bg-white my-3 mx-3 rounded-15">
                        <div class="col-4 my-3">
                            <img src="<?= $element['picture']; ?>" style="width: 220px; height: 130px;">
                        </div>
                        <div class="col-5 my-3">
                            <h5><strong><?= GeneralController::FormattedTitle($element['title']); ?></strong></h5>
                            <small>Seller:JeanDanielEuvince</small>
                            <h5 class="mt-2"><strong>Price : <?= $element['price']; ?>$</strong></h5>
                            <a href="" class="btn btn-warning <?=$disabled?> btn-sm mt-1">Makes Changes</a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#deleteElement<?= $count ?>" class="btn btn-danger <?=$disabled?> btn-sm mt-1">Remove</a>
                        </div>
                        <!-- <div class="col-3" style="margin-top: 70px; display:flex;">
                            <form action="" method="POST">
                                <button name="minus" id="minus" onclick="decreased();" style="font-size:14px; border:1px solid; cursor:pointer; border-radius:50%;"> <i class="fa-solid fa-minus"></i></button>
                            </form>
                            <div class="mx-2"><input type="text" name="quantity" value="" style="width:30px; border:1px solid; border-radius:15%;padding-left:8px; font-size:14px"></div>
                            <form action="" method="POST">
                                <button name="plus" id="plus" onclick="increased();" style="font-size:14px; border:1px solid; cursor:pointer; border-radius:50%; "> <i class="fa-solid fa-plus"></i></button>
                            </form>
                        </div> -->
                    </div>

                    <div class="modal fade" id="deleteElement<?= $count ?>">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Voulez-vous vraiment supprimer cet article du panier?</p>
                            </div>
                            <div class="modal-footer">
                                <a href="<?= URL ?>pannier/s/<?= $key ?>" type="button" class="btn btn-primary">Save changes</a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="col-4 bg-white my-3" style="border:1px solid grey; height:220px;">
            <div class="row">
                <p style="margin-top: 10px;">PRICE DETAILS</p>
                <hr>
                <div class="row">
                    <div class="col">
                        <p>Price(<?= isset($elements) ? count($elements) : ''; ?> items)</p>
                        <p>Delivery Charges</p>
                    </div>
                    <div class="col">
                        <p><?= isset($element) ? $total : 0 ?>$</p>
                        <p style="color:green">FREE</p>
                    </div>
                    <div class="row">
                         <div class="col"><hr></div>
                        <div class="col"><hr></div>
                    </div>
                    <div class="row">
                        <div class="col">Amount Payable</div>
                        <div class="col">$<?= isset($element) ? $total : 0 ?></div>
                    </div>
                </div>
            </div>
            <?php if(!array_key_exists('user', $_SESSION)): ?>
                <div class="row my-3">
                    <form action="" method="POST">
                        <input type="hidden" value="<?= isset($element) ? $total : 0 ?>" name="total">
                        <button name="add" type="submit" class="btn btn-primary my-5 w-100"><i class="fa-sharp fa-solid fa-money-bill-wave mx-2"></i>Veuillez cliquer pour commander<i class="fa-solid fa-cart-shopping mx-2"></i></button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$title = "Mon Pannier";
$content = ob_get_clean();
require "template.php";
?>