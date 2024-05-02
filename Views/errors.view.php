<?php

ob_start();

?>

<?php 

echo <<<HTML
    <style>
        .custom-alert {
            border-radius: 8px;
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
    <div class="alert alert-dismissible alert-danger custom-alert">
        <strong>$msg!!!</strong> 
    </div>
HTML;

?>

<?php 

$title = 'ERROR 404 !!!';
$content = ob_get_clean();

require "template.php";

?>