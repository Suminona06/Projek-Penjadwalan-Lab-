<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SiswaModel;

class Usdatasis extends BaseController
{
    public function index()
    {
        $siswaModel = new SiswaModel();
        $siswa = $siswaModel->findAll(); // Mengambil data pegawai dari model
    
        return view('view-users/usdatasis', ['siswa' => $siswa]); // Mengirim data pegawai ke view
    }
}