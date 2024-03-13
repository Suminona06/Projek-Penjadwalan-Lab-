<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\fasilitas_softwareModel;
use App\Models\fasilitas_hardwareModel;
use App\Models\barangModel;


use App\Models\RuanganModel;
use CodeIgniter\HTTP\ResponseInterface;

class Usfasilitas extends BaseController
{
    public function index()
    {
        // Ambil data gambar fasilitas dari model
        $fasilitasModel = new Fasilitas_SoftwareModel();
        $fasilitas = $fasilitasModel->joinRuangan()->orderByRuangan()->findAll();

        // Ambil data gambar fasilitas dari model
        $fasilitashwModel = new Fasilitas_HardwareModel();
        $fasilitashw = $fasilitashwModel->joinRuangan()->orderByRuangan()->findAll();

        // Ambil data barang dari model
        $barangModel = new BarangModel();
        $barang = $barangModel->joinRuangan()->orderByRuangan()->findAll();

        // Inisialisasi array kosong untuk menyimpan data fasilitas dan barang berdasarkan id ruangan
        $ruangan = [];

        // Kelompokkan data fasilitas software berdasarkan id ruangan
        foreach ($fasilitas as $gambar) {
            $idRuangan = $gambar['id_ruangan'];

            // Tambahkan data fasilitas ke dalam array ruangan yang sesuai
            $ruangan[$idRuangan]['fasilitas'][] = $gambar;
        }


        // Kelompokkan data fasilitas hardware berdasarkan id ruangan
        foreach ($fasilitashw as $gambarhw) {
            $idRuangan = $gambarhw['id_ruangan'];

            // Tambahkan data fasilitas ke dalam array ruangan yang sesuai
            $ruangan[$idRuangan]['fasilitashw'][] = $gambarhw;
        }



        // Kelompokkan data barang berdasarkan id ruangan
        foreach ($barang as $databrg) {
            $idRuangan = $databrg['id_ruangan'];

            // Tambahkan data barang ke dalam array ruangan yang sesuai
            $ruangan[$idRuangan]['barang'][] = $databrg;
        }

        // Ambil data ruangan dari model
        $ruanganModel = new RuanganModel();
        $ruanganData = $ruanganModel->findAll();

        // Kemudian kirimkan data ruangan beserta data fasilitas dan barang ke view
        return view('view-users/usfasilitas', [
            'ruangan' => $ruangan,
            'modelRuangan' => $ruanganModel,
            'ruanganData' => $ruanganData
        ]);
    }

}