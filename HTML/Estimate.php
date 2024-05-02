<?php  

namespace HTML;

use Controllers\CartController;
use Controllers\GeneralController;

class Estimate 
{
    public static function displayEstimate()
    {
        $elements = CartController::loadSessionArticles();
        $total = 0;
        $date_day = date('Y-m-d');
        $html = <<<HTML
            <style type="text/css">
            table{border-collapse: collapse; width: 100%; font-size: 12pt; font-family: helvetica; line-height: 4mm;}
            table strong{color: #000;}
            em {font-size:  9pt;}
            td.right {text-align: right;}
            h1 {color:  #000; margin: 0; padding: 0;}
            table.border td{border: 1px solid #CFD1D2; padding: 3mm 1mm;}
            table.border th{background: #000; color: #FFF; font-weight: normal; border: solid 1px #FFF; text-align: left; padding: 1.5mm 1mm;}
            td.noborder{border: none;}
            p{margin: 0; padding: 2mm 0;}
            hr{height: 3px;}

            </style>

            <page backtop="15mm" backleft="10mm" backright="10mm" backbottom="30mm" footer="page; date;">
            <page_footer>
                <hr>
                <h1>Bon de commande</h1>
                <p>Date : {$date_day}</p>
                <p>Signature et cachet de l'entreprise, précédée de la mention manuscrite &laquo;Bon pour accord&raquo;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </page_footer>
            <!-- <bookmark title="Informations" level="0"></bookmark> -->
            <table style="vertical-align: none;">
                <tr>
                    <td style="width: 75%;">
                        <strong>Entreprise</strong><br>
                        Adresse<br>
                        <strong>SIRET :</strong>00 00-10-000<br> <br>
                        <em>
                            Dispens&eacute; d'immatriculaion au régistre du commerce <br>
                            et des soci&eacute;t&eacute;s (RCS) et au r&eacute;pertoire des métiers (RM)
                        </em>
                    </td>
                    <td style="width: 25%;">
                        <strong>Euvince</strong><br>
                        Infos du client<br>
                    </td>
                </tr>
            </table>

            <table style="vertical-align: bottom; margin-top: 12mm;">
                <tr>
                    <td  style="width: 50%;"><h1>DEVIS N°20456</h1></td>
                    <td class="right" style="width: 50%;">Émis le 12/12/85</td>
                    <td></td>
                </tr>
            </table>
            <!--  <bookmark title="Details" level="0"></bookmark> -->
            <table class="border">
                <thead>
                    <tr>
                        <th style="width: 60%;">Description</th>
                        <th style="width: 11%;">Quantité</th>
                        <th style="width: 17%;">Prix Unitaire</th>
                        <th style="width: 12%;">Montant</th>
                    </tr>
                </thead>
                <tbody>
        HTML;
                array_map(function($element) use (&$html, &$total){
                    $title = GeneralController::FormattedTitle($element['title']);
                    $describe = GeneralController::Excerpt($element['content'], 50);
                    $price = $element['price'];
                    $quantity = '12kg';
                    $created_at = $element['created_at'];
                    $total += $price;
                    $html .= <<<HTML
                    <tr>
                        <td>{$title}<br><br>{$describe}<br><br>$created_at</td>
                        <td>{$quantity}</td>
                        <td>{$price}$</td>
                        <td>{$price}$</td>
                    </tr>
                HTML;
                }, $elements);
        $html .= <<<HTML
                        <tr>
                            <td colspan="2" class="noborder"></td> TVA non applicable, art 293 B du CGI
                            <th class="black">Total :</th>
                            <td>{$total}$</td>
                        </tr>
                    </tbody>
                </table>
            </page>
        HTML;

        return $html;
    }
}