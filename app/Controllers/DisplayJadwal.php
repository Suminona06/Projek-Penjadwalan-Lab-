<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JadwalModel;
use App\Models\JadwalDetailModel;

class DisplayJadwal extends BaseController
{
    public function display1()
    {
        $jadwalModel = new JadwalModel();
        $jadwalDetail = new JadwalDetailModel();

        // Fetch required data from the model
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
        $hari0 = $jadwalModel->getHari('Senin');
        $hari1 = $jadwalModel->getHari('Selasa');
        $hari2 = $jadwalModel->getHari('Rabu');
        $hari3 = $jadwalModel->getHari('Kamis');
        $hari4 = $jadwalModel->getHari('Jumat');
        $jam = $jadwalModel->getJam();
        $ruangan = $jadwalModel->getRuangan();
        $jadwal1 = $jadwalModel->getJadwal();
        $jumlahLab = count($ruangan);



        // Initialize variables
        $message = '';
        $jadwalData = [];

        // Fetching current day and time
        date_default_timezone_set('Asia/Jakarta');
        $hari_ini = date('N');
        $jam_sekarang = date('H.i');

        // Checking if it's a weekend or before 07:00
        if ($hari_ini > 5 || $jam_sekarang < '07.00') {
            $message = "Saat ini bukan waktu untuk melihat jadwal karena sedang libur";

        } elseif ($jam_sekarang >= '17.30') {
            $message = "Sedang tidak ada jadwal di lab saat ini";
        } else {
            // Set initial jam_id based on current time
            if ($jam_sekarang >= '07.00' && $jam_sekarang < '07.50') {
                $jam_id = 1;
            } elseif ($jam_sekarang >= '07.50' && $jam_sekarang < '08.40') {
                $jam_id = 2;
            } elseif ($jam_sekarang >= '08.40' && $jam_sekarang < '09.30') {
                $jam_id = 3;
            } elseif ($jam_sekarang >= '09.30' && $jam_sekarang < '10.40') {
                $jam_id = 4;
            } elseif ($jam_sekarang >= '10.40' && $jam_sekarang < '11.30') {
                $jam_id = 5;
            } elseif ($jam_sekarang >= '11.30' && $jam_sekarang < '12.50') {
                $jam_id = 6;
            } elseif ($jam_sekarang >= '12.50' && $jam_sekarang < '13.40') {
                $jam_id = 7;
            } elseif ($jam_sekarang >= '13.40' && $jam_sekarang < '14.30') {
                $jam_id = 8;
            } elseif ($jam_sekarang >= '14.30' && $jam_sekarang < '15.20') {
                $jam_id = 9;
            } elseif ($jam_sekarang >= '15.20' && $jam_sekarang < '16.40') {
                $jam_id = 10;
            } elseif ($jam_sekarang >= '16.40' && $jam_sekarang < '17.30') {
                $jam_id = 11;
            }
        }

        // Fetching jadwal data based on the current day and time
        if (!empty($jam_id)) {
            $jadwalData = $jadwalDetail->getJadwalByJam($hari_ini, $jam_id);
        }

        // Combine data for the view
        $data = [
            'pageTitle' => 'Jadwal Reguler',
            'thn_awal' => $thn_awal,
            'thn_akhir' => $thn_akhir,
            'message' => $message,
            'jadwalData' => $jadwalData,
            'jadwal' => $jadwal1,
            'hari' => $hari_ini,
            'hari0' => $hari0,
            'hari1' => $hari1,
            'hari2' => $hari2,
            'hari3' => $hari3,
            'hari4' => $hari4,
            'jam' => $jam,
            'ruangan' => $ruangan,
            'jumlahLab' => $jumlahLab,
        ];

        // Start output buffering
        ob_start();

        // Load the views and capture their output
        view('display/jadwal/jadwalReguler', $data);
        view('display/jadwal/jadwalSelasa', $data);
        view('display/jadwal/jadwalRabu', $data);
        view('display/jadwal/jadwalKamis', $data);
        view('display/jadwal/jadwalJumat', $data);

        // Get the content of the output buffer and clean it
        $viewContent = ob_get_clean();

        // Pass the view content along with other data to the display view
        return view('display/jadwal/display-jadwal', $data);
    }



    public function display()
    {
        $jadwalModel = new JadwalModel();
        $jadwalDetail = new JadwalDetailModel();

        // Fetch required data for display view
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();

        date_default_timezone_set('Asia/Jakarta');
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $date = date('3');
        $clock = date('H.i');

        $message = '';
        $jadwalData = [];

        if ($hari[$date] == "Sabtu" || $hari[$date] == "Minggu") {
            $message = "Sekarang hari Sabtu / Minggu, tidak ada pelajaran";
        } elseif ($clock < '07.00') {
            $message = "Tidak ada Lab yang dipakai pada jam ini";
        } else {
            $jam_id = 1;

            if ($clock >= '17.30') {
                $jam_id = 11;
            } elseif ($clock >= '16.40') {
                $jam_id = 10;
            } elseif ($clock >= '15.20') {
                $jam_id = 9;
            } elseif ($clock >= '14.30') {
                $jam_id = 8;
            } elseif ($clock >= '13.40') {
                $jam_id = 7;
            } elseif ($clock >= '12.50') {
                $jam_id = 6;
            } elseif ($clock >= '11.30') {
                $jam_id = 5;
            } elseif ($clock >= '10.40') {
                $jam_id = 4;
            } elseif ($clock >= '09.30') {
                $jam_id = 3;
            } elseif ($clock >= '08.40') {
                $jam_id = 2;
            }

            $jadwalData = $jadwalDetail->getJadwalByJam($hari[$date], $jam_id);
        }

        $data = [
            'pageTitle' => 'Jadwal Reguler',
            'thn_awal' => $thn_awal,
            'thn_akhir' => $thn_akhir,
            'message' => $message,
            'jadwal' => $jadwalData
        ];

        return view('display/jadwal/display-jadwal', $data);
    }


}