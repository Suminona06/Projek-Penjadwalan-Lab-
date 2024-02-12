<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use App\Models\fasilitas_softwareModel;

class PdfController extends BaseController
{
    public function exportPdf()
    {
        $model = new fasilitas_softwareModel();
        // Load data
        $data = $model->getData();

        // Render HTML
        $html = view('pdf/laporan', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="laporan.pdf"');
        return $this->response->setBody($output);
    }
}
