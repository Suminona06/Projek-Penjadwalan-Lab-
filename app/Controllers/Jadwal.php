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
        $jadwal = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->paginate(10, 'jadwal');

        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $jadwal,
            'pager' => $jadwalModel->pager
        ];
        return view('jadwal/jadwal-reguler', $data);
    }

    public function delete_jadwal($id_jadwal)
    {
        $barangModel = new JadwalModel();
        $barangModel->delete(['id_jadwal' => $id_jadwal]);
        return redirect()->to('admin/jadwal');
    }
}
