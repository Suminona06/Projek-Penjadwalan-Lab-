<?php

namespace App\Controllers;

use App\Models\GaleriModel;

class Galeri extends BaseController
{
    public function index()
    {
        $galeriModel = new GaleriModel();

        $galeri = $galeriModel->joinRuangan()->orderByRuangan()->findAll(); // Mengambil semua data galeri dan mengurutkannya berdasarkan ID ruangan

        $data = [
            'galeri' => $galeri,
            'pageTitle' => "Galeri",
        ];

        return view('view-users/usgaleri', $data);
    }

}