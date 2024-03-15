<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\barangModel;
use App\Models\jurusanModel;
use App\Models\RuanganModel;
use App\Models\JadwalModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use App\Models\th_ajarModel;
use App\Models\prodiModel;
use App\Models\unitModel;
use App\Models\PegawaiModel;
use App\Models\SiswaModel;
use App\Models\userModel;
use App\Models\kritikModel;
use App\Models\fasilitas_softwareModel;
use App\Models\fasilitas_hardwareModel;


class PdfController extends BaseController
{
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

    public function exportTA()
    {
        $thjrModel = new th_ajarModel();
        $data = [
            'ta' => $thjrModel->findAll(),
            'pageTitle' => "Tahun Ajaran",
        ];

        $view = view('pdf/export-ta', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-TA.pdf"');
        return $this->response->setBody($output);
    }

    public function exportJurusan()
    {
        $jurusanModel = new jurusanModel();
        $data = [
            'jurusan' => $jurusanModel->findAll(),
            'pageTitle' => "Jurusan",
        ];

        $view = view('pdf/export-jurusan', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-Jurusan.pdf"');
        return $this->response->setBody($output);
    }
    public function exportProdi()
    {
        $prodiModel = new prodiModel();
        $data = [
            'prodi' => $prodiModel->joinJurusan()->findAll(),
            'pageTitle' => "Jurusan",
        ];

        $view = view('pdf/export-prodi', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-Prodi.pdf"');
        return $this->response->setBody($output);
    }
    public function exportUnit()
    {
        $unitModel = new unitModel();
        $data = [
            'prodi' => $unitModel->findAll(),
            'pageTitle' => "Unit",
        ];

        $view = view('pdf/export-unit', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-Unit.pdf"');
        return $this->response->setBody($output);
    }
    public function exportUser()
    {
        $userModel = new userModel();
        $data = [
            'user' => $userModel->joinProdi()->findAll(),
            'pageTitle' => "Prodi",
        ];

        $view = view('pdf/export-user', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-User.pdf"');
        return $this->response->setBody($output);
    }
    public function exportKritik()
    {
        $kritik = new kritikModel();
        $data = [
            'kritik' => $kritik->findAll(),
            'pageTitle' => "Prodi",
        ];

        $view = view('pdf/export-kritik', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-Kritik.pdf"');
        return $this->response->setBody($output);
    }
    public function exportPegawai()
    {
        $pegawai = new PegawaiModel();
        $data = [
            'pegawai' => $pegawai->findAll(),
            'pageTitle' => "Pegawai",
        ];

        $view = view('pdf/export-pegawai', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-Pegawai.pdf"');
        return $this->response->setBody($output);
    }
    public function exportSiswa()
    {
        $siswa = new SiswaModel();
        $data = [
            'siswa' => $siswa->findAll(),
            'pageTitle' => "Pegawai",
        ];

        $view = view('pdf/export-siswa', $data);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $output = $dompdf->output();

        // Download PDF
        $this->response->setContentType('application/pdf');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="data-Siswa.pdf"');
        return $this->response->setBody($output);
    }
}
