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
        $hari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu'
        ];
        // Fetching current day and time
        date_default_timezone_set('Asia/Jakarta');
        $hari_ini = $hari[date('N')];
        $jam_sekarang = date('H.i');

        // Checking if it's a weekend or before 07:00
        if (date('N') > 5 || $jam_sekarang < '07.00') {
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

            // Fetching jadwal data based on the current day and time
            if ($jam_id) {
                $jadwalData = $jadwalDetail->getJadwalByJam($hari_ini, $jam_id);
            }
        }

        // Combine data for the view
        $data = [
            'pageTitle' => 'Jadwal Reguler',
            'thn_awal' => $thn_awal,
            'thn_akhir' => $thn_akhir,
            'message' => $message,
            'jadwalData' => $jadwalData, // <-- Assign the fetched jadwalData to this variable
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


    // Endpoint to fetch updated jadwal data based on current time
    public function getJadwalData()
    {
        $jadwalModel = new JadwalModel();
        $jadwalDetail = new JadwalDetailModel();

        // Initialize variables
        $message = '';
        $jadwalData = [];
        $hari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu'
        ];

        // Fetching current day and time
        date_default_timezone_set('Asia/Jakarta');
        $hari_ini = $hari[date('N')];
        $jam_sekarang = date('H.i');

        // Checking if it's a weekend or before 07:00
        if (date('N') > 5 || $jam_sekarang < '07.00') {
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

            // Fetching jadwal data based on the current day and time
            if ($jam_id) {
                $jadwalData = $jadwalDetail->getJadwalByJam($hari_ini, $jam_id);
            }
        }

        // Combine data for the view
        $data = [
            'message' => $message,
            'jadwalData' => $jadwalData,
        ];

        return $data;
    }


    public function fetchUpdatedJadwal()
    {
        $data = $this->getJadwalData(); // Fetch updated data

        echo json_encode($data); // Return data as JSON
        exit();
    }


    public function regulerDisplay()
    {
        $jadwalModel = new JadwalModel();

        // Fetch required data from the model
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
        $semester = $jadwalModel->getSemester();
        $hari = $jadwalModel->getHari();
        $jam = $jadwalModel->getJam();
        $ruangan = $jadwalModel->getRuangan();
        $jadwal = $jadwalModel->getJadwal();

        // Calculate the number of rooms
        $jumlahLab = count($ruangan);

        $data = [
            'thn_awal' => $thn_awal,
            'thn_akhir' => $thn_akhir,
            'hari' => $hari,
            'jam' => $jam,
            'ruangan' => $ruangan,
            'jadwal' => $jadwal,
            'jumlahLab' => $jumlahLab,
            'semester' => $semester// Pass the calculated value to the view


        ];

        return view('display/jadwal/vReguler', $data);

    }

    public function allJadwal()
    {
        $jadwalModel = new JadwalModel();
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
        $semester = $jadwalModel->getSemester();

        $jadwal = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', 'REGULER')->where('jadwal.hari', 'Senin')->findAll();

        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $jadwal,
            'thn_awal' => $thn_awal,
            'thn_akhir' => $thn_akhir,
            'semester' => $semester
        ];

        return view('display/hari/senin', $data);
    }
    public function hariSelasa()
    {
        $jadwalModel = new JadwalModel();
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
        $semester = $jadwalModel->getSemester();

        $jadwal = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', 'REGULER')->where('jadwal.hari', 'Selasa')->findAll();

        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $jadwal,
            'thn_awal' => $thn_awal,
            'thn_akhir' => $thn_akhir,
            'semester' => $semester
        ];

        return view('display/hari/selasa', $data);
    }
    public function hariRabu()
    {
        $jadwalModel = new JadwalModel();
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
        $semester = $jadwalModel->getSemester();

        $jadwal = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', 'REGULER')->where('jadwal.hari', 'Rabu')->findAll();

        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $jadwal,
            'thn_awal' => $thn_awal,
            'thn_akhir' => $thn_akhir,
            'semester' => $semester
        ];

        return view('display/hari/rabu', $data);
    }
    public function hariKamis()
    {
        $jadwalModel = new JadwalModel();
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
        $semester = $jadwalModel->getSemester();

        $jadwal = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', 'REGULER')->where('jadwal.hari', 'Kamis')->findAll();

        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $jadwal,
            'thn_awal' => $thn_awal,
            'thn_akhir' => $thn_akhir,
            'semester' => $semester
        ];

        return view('display/hari/kamis', $data);
    }
    public function hariJumat()
    {
        $jadwalModel = new JadwalModel();
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
        $semester = $jadwalModel->getSemester();

        $jadwal = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', 'REGULER')->where('jadwal.hari', 'Jumat')->findAll();

        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $jadwal,
            'thn_awal' => $thn_awal,
            'thn_akhir' => $thn_akhir,
            'semester' => $semester
        ];

        return view('display/hari/jumat', $data);
    }


}