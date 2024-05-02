<?php

use Controllers\StatisticsController;
use Models\ProductManager;

ob_start();

?>

<?php
if (array_key_exists('user', $_SESSION)) header('Location: ' . URL .'acceuil'); 
if (isset($is_admin) && $is_admin === true){
    $_SESSION['admin'] = $is_admin;
}

?>

<?php 

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true)
{
    $nbProducts = ProductManager::getNbPages('products') * 8;
    $productUri = URL .'produits';
    $nbDishes = ProductManager::getNbPages('dishes') * 8;
    $dishUri = URL .'plats';
    $nbRefreshments = ProductManager::getNbPages('refreshments') * 8;
    $refreshmentUri = URL .'rafraîchissements';
    $loadAllElements = json_encode(StatisticsController::loadAllElements(), JSON_NUMERIC_CHECK);
    echo <<<HTML
    <script>
    window.onload = function() {

    var chart = new CanvasJS.Chart("chartContainer", {
        theme: "light2",
        exportEnabled: true,
        animationEnabled: true,
        title: {
            text: "Répartition de vos Éléments et Données"
        },
        data: [{
            type: "pie",
            startAngle: 25,
            toolTipContent: "<b>{label}</b>: {y}%",
            showInLegend: "true",
            legendText: "{label}",
            indexLabelFontSize: 16,
            indexLabel: "{label} - {y}%",
            dataPoints: [
			{ y: 51.08, label: "Rafraîchissements" },
			{ y: 24.96, label: "Produits" },
			{ y: 24.96, label: "Plats" },
		]
        }]
    });
    chart.render();

    }
    </script>

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-primary mb-3" style="height: 600px">
                        <div class="card-header">Statistiques</div>
                        <div class="card-body">
                            <h4 class="card-title"></h4>
                            <div class="card-text" id="chartContainer"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-primary mb-3" style="height: 600px">
                        <div class="card-header">Statistiques Générales</div>
                        <div class="card-body">
                            <h4 class="card-title text-center mt-5"><a href="$dishUri" style="text-decoration: none;">
                                <span class="badge bg-primary rounded">$nbDishes</span>
                                Plats
                            </a></h4> <hr>
                            <h4 class="card-title text-center mt-5"><a href="$productUri" style="text-decoration: none;">
                                <span class="badge bg-primary rounded">$nbProducts</span>
                                Produits
                            </a></h4> <hr>
                            <h4 class="card-title text-center mt-5"><a href="$refreshmentUri" style="text-decoration: none;">
                                <span class="badge bg-primary rounded">$nbRefreshments</span>
                                Rafraîchissements
                            </a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
HTML;
}

?>

<?php 

$title = ((isset($_SESSION['admin']) && $_SESSION['admin'] === true)) ? 'VISUALISEZ VOS STATISTIQUES' : '';
$content = ob_get_clean();

require "template.php";

?>