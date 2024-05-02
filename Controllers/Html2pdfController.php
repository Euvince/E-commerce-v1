<?php 

namespace Controllers;

use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

class Html2pdfController
{
    public static function generatePDF($content)
    {
        try
        {
            $pdf = new Html2Pdf('P', 'A4', 'fr');
            $pdf->pdf->setDisplayMode('fullpage');
            $pdf->writeHTML($content);
            $pdf->output('Mon Devis.pdf', 'D');
        }
        catch(Html2PdfException $e)
        {
            die($e);
        }
    }
}
