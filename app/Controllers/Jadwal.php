<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JadwalModel;

class Jadwal extends BaseController
{
    public function index()
    {
        $jadwalModel = new JadwalModel();
        $jadwal = $jadwalModel->paginate(10, 'jadwal');

        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $jadwal,
            'pager' => $jadwalModel->pager
        ];
        return view('jadwal/jadwal-reguler', $data);
    }
}
