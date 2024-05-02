<?php 

namespace Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;

class DompdfController
{
    protected $dompdf;

    protected $options;

    public function __construct()
    {
        $this->options = new Options();
        $this->dompdf = new Dompdf($this->options);
    }

    public function generatePDF(string $html, ?string $filename = "")
    {

       /*  ob_start();
        require_once $file_path;
        $content = ob_get_clean(); */

        $this->dompdf->loadHtml($html);

        /* $this->dompdf->setPaper('A4', 'landscape'); */

        $this->dompdf->render();

        $this->dompdf->stream($filename);
    }
}