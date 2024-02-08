<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\HardwareLab10;
use App\Models\HardwareLab9;
use App\Models\RuanganModel;

class HardwareController extends BaseController
{
    public function detail($id_ruangan)
    {

        // Tentukan model yang sesuai dengan ruangan
        $model = 'App\Models\HardwareLab' . $id_ruangan;

        // Buat instance model yang sesuai
        $hardwareModel = new $model;

        $fasilitas = $hardwareModel->paginate(10, 'lab2');
        $data = [
            'pageTitle' => 'Lab Hardware',
            'lab2' => $fasilitas,
            'pager' => $hardwareModel->pager
        ];
        return view('hardware/lab_2', $data);
    }

    public function add_data_lab9()
    {
        $softwareModel = new HardwareLab9;
        return view('hardware/add_data_lab');
    }

    public function save_data_lab9()
    {
        $softwareModel = new HardwareLab9;
        $softwareModel->insert($this->request->getPost());
        return redirect()->to('admin/pengolahan_lab');
    }

    public function delete_data_lab9($id_pc)
    {
        $fasilitas = new HardwareLab9;
        $fasilitas->delete(['id_pc' => $id_pc]);
        return redirect()->to('admin/pengolahan_lab');
    }

    public function edit_lab9($id_pc)
    {
        $hardwareDelete = new HardwareLab9;
        $data = [
            'pageTitle' => 'Lab 1',
            'hardware' => $hardwareDelete->where('id_pc', $id_pc)->first()
        ];

        return view('hardware/edit_data_lab9', $data);
    }

    public function update_lab9($id_pc)
    {
        $hardwareModel = new HardwareLab9;
        $data = $this->request->getPost();
        $hardwareModel->update($id_pc, $data);
        return redirect()->to('admin/pengolahan_lab');

    }
}
