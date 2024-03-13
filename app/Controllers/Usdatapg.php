<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PegawaiModel;

class Usdatapg extends BaseController
{
    public function index()
{
    $pegawaiModel = new PegawaiModel();
    $pegawai = $pegawaiModel->findAll(); // Mengambil data pegawai dari model

    return view('view-users/usdatapg', ['pegawai' => $pegawai]); // Mengirim data pegawai ke view
}

}