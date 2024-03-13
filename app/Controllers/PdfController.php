<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\barangModel;
use App\Models\RuanganModel;
use App\Models\JadwalModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use App\Models\HardwareLab10;
use App\Models\HardwareLab9;
use App\Models\HardwareLab11;
use App\Models\HardwareLab12;
use App\Models\HardwareLab14;
use App\Models\HardwareLab13;
use App\Models\HardwareLab15;
use App\Models\HardwareLab16;
use App\Models\fasilitas_softwareModel;
use App\Models\fasilitas_hardwareModel;


class PdfController extends BaseController
{
    public function exportPdf($modelNumber)
    {
        switch ($modelNumber) {
            case 9:
                $model = new HardwareLab9();
                break;
            case 10:
                $model = new HardwareLab10();
                break;
            case 11:
                $model = new HardwareLab11();
                break;
            case 12:
                $model = new HardwareLab12();
                break;
            case 13:
                $model = new HardwareLab13();
                break;
            case 14:
                $model = new HardwareLab14();
                break;
            case 15:
                $model = new HardwareLab15();
                break;
            case 16:
                $model = new HardwareLab16();
                break;
            // Tambahkan case lainnya sesuai dengan model yang Anda miliki
            default:
                // Jika nomor model tidak cocok, kembalikan dengan pesan kesalahan
                return redirect()->back()->with('error', 'Nomor model tidak valid.');
        }

        $data = [
            'pageTitle' => 'export pdf',
            'model' => $model->findAll(),
            'modelNumber' => $modelNumber
        ];
        // Render HTML
        //$html = view('fasilitas_software/pdf', $data);
        $view = view('pdf/export-pdf', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-fasilitas-hardware.pdf"');
        return $this->response->setBody($output);
    }

    public function exportHardware($id_ruangan)
    {
        $model = new fasilitas_hardwareModel();
        $ruanganModel = new RuanganModel();

        $data = [
            'pageTitle' => 'export pdf',
            'model' => $model->where('id_ruangan', $id_ruangan)->findAll(),
            'ruangan' => $ruanganModel->find($id_ruangan)
        ];

        $view = view('pdf/export-hardware', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-fasilitas-hardware.pdf"');
        return $this->response->setBody($output);
    }


    public function exportRuangan()
    {
        $ruanganModel = new RuanganModel();

        $data = [
            'pageTitle' => 'export pdf',
            'ruangan' => $ruanganModel->joinPegawai()->findAll()
        ];

        $view = view('pdf/export-ruangan', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-ruangan.pdf"');
        return $this->response->setBody($output);
    }
    public function exportBarang()
    {
        $barangModel = new barangModel();

        $data = [
            'pageTitle' => 'export pdf',
            'barang' => $barangModel->joinRuangan()->findAll()
        ];

        $view = view('pdf/export-barang', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-barang.pdf"');
        return $this->response->setBody($output);
    }
    public function exportJadwal()
    {
        $jadwalModel = new JadwalModel();

        $data = [
            'pageTitle' => 'export pdf',
            'jadwal' => $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jadwal.jenis', 'REGULER')->findAll()
        ];

        $view = view('pdf/export-jadwal', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="jadwal-reguler.pdf"');
        return $this->response->setBody($output);
    }
    public function exportJadwalNonReguler()
    {
        $jadwalModel = new JadwalModel();

        $data = [
            'pageTitle' => 'export pdf',
            'jadwal' => $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jadwal.jenis', 'NONREGULER')->findAll()
        ];

        $view = view('pdf/export-jadwal', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="jadwal-nonreguler.pdf"');
        return $this->response->setBody($output);
    }

    public function exportJadwalUAS()
    {
        $jadwalModel = new JadwalModel();

        $data = [
            'pageTitle' => 'export pdf',
            'jadwal' => $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jadwal.jenis', 'UAS')->findAll()
        ];

        $view = view('pdf/export-jadwal', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="jadwal-uas.pdf"');
        return $this->response->setBody($output);
    }

    public function exportJadwalUTS()
    {
        $jadwalModel = new JadwalModel();

        $data = [
            'pageTitle' => 'export pdf',
            'jadwal' => $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jadwal.jenis', 'UTS')->findAll()
        ];

        $view = view('pdf/export-jadwal', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="jadwal-uts.pdf"');
        return $this->response->setBody($output);
    }






    // -------------EXPORT JADWAL USER PRODI --------------------------------- \\
    public function exportSoftware($id_ruangan)
    {
        $model = new fasilitas_softwareModel();
        $ruanganModel = new RuanganModel();

        $data = [
            'pageTitle' => 'export pdf',
            'model' => $model->where('id_ruangan', $id_ruangan)->findAll(),
            'ruangan' => $ruanganModel->find($id_ruangan)
        ];

        $view = view('pdf/export-software', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-fasilitas-software.pdf"');
        return $this->response->setBody($output);
    }
    public function exportProdiReguler($idProdi)
    {
        $jadwalModel = new JadwalModel();
        $jadwalProdi = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jadwal.id_prodi', $idProdi)->where('jenis', 'REGULER')->findAll();
        $data = [
            'pageTitle' => 'export pdf',
            'jadwal' => $jadwalProdi
        ];

        $view = view('pdf/export-reguler', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="prodi-reguler.pdf"');
        return $this->response->setBody($output);
    }
    public function exportProdiNonReguler($idProdi)
    {
        $jadwalModel = new JadwalModel();
        $jadwalProdi = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jadwal.id_prodi', $idProdi)->where('jenis', 'NONREGULER')->findAll();
        $data = [
            'pageTitle' => 'export pdf',
            'jadwal' => $jadwalProdi
        ];

        $view = view('pdf/export-reguler', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="prodi-nonreguler.pdf"');
        return $this->response->setBody($output);
    }
    public function exportProdiUAS($idProdi)
    {
        $jadwalModel = new JadwalModel();
        $jadwalProdi = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jadwal.id_prodi', $idProdi)->where('jenis', 'UAS')->findAll();
        $data = [
            'pageTitle' => 'export pdf',
            'jadwal' => $jadwalProdi
        ];

        $view = view('pdf/export-reguler', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="prodi-UAS.pdf"');
        return $this->response->setBody($output);
    }
    public function exportProdiUTS($idProdi)
    {
        $jadwalModel = new JadwalModel();
        $jadwalProdi = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jadwal.id_prodi', $idProdi)->where('jenis', 'UTS')->findAll();
        $data = [
            'pageTitle' => 'export pdf',
            'jadwal' => $jadwalProdi
        ];

        $view = view('pdf/export-reguler', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="prodi-UTS.pdf"');
        return $this->response->setBody($output);
    }
}
