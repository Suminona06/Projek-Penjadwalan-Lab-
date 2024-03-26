<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JadwalModel;
use App\Models\JadwalDetailModel;

class DisplayJadwal extends BaseController
{
    public function index()
    {
        $jadwalModel = new JadwalModel();

        // Fetch required data from the model
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
        $hari = $jadwalModel->getHari('Senin');
        $hari1 = $jadwalModel->getHari('Selasa');
        $hari2 = $jadwalModel->getHari('Rabu');
        $hari3 = $jadwalModel->getHari('Kamis');
        $hari4 = $jadwalModel->getHari('Jumat');
        $jam = $jadwalModel->getJam();
        $ruangan = $jadwalModel->getRuangan();
        $jadwal = $jadwalModel->getJadwal();

        // Calculate the number of rooms
        $jumlahLab = count($ruangan);

        $data = [
            'thn_awal' => $thn_awal,
            'thn_akhir' => $thn_akhir,
            'hari' => $hari,
            'hari1' => $hari1,
            'hari2' => $hari2,
            'hari3' => $hari3,
            'hari4' => $hari4,
            'jam' => $jam,
            'ruangan' => $ruangan,
            'jadwal' => $jadwal,
            'jumlahLab' => $jumlahLab, // Pass the calculated value to the view
        ];

        // Load the view jadwalReguler and pass the data to it
        ob_start(); // Start output buffering
        view('display/jadwal/jadwalReguler', $data); // Load the view
        view('display/jadwal/jadwalSelasa', $data); // Load the view
        view('display/jadwal/jadwalRabu', $data); // Load the view
        view('display/jadwal/jadwalKamis', $data); // Load the view
        view('display/jadwal/jadwalJumat', $data); // Load the view
        $viewContent = ob_get_clean(); // Get the content of the output buffer and clean it


        return view('display/jadwal/display-jadwal', ['pageTitle' => 'Jadwal Reguler', 'viewContent' => $viewContent]);
    }


    public function Display()
    {
        $jadwalModel = new JadwalModel();

        // Fetch required data for display view
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();

        $data = [
            'pageTitle' => 'Jadwal Reguler',
            'thn_awal' => $thn_awal,
            'thn_akhir' => $thn_akhir,
        ];
        return view('display/jadwal/display-jadwal', $data);
    }

}
