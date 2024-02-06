<?php

namespace App\Controllers;

use App\Models\fasilitas_hardwareModel;
use App\Models\fasilitas_softwareModel;
use App\Models\RuanganModel;
use App\Models\barangModel;
use App\Models\galeriModel;

class Fasilitas extends BaseController
{
    public function index()
    {
        $hardwareModel = new fasilitas_hardwareModel();
        $fasilitas = $hardwareModel->paginate(10, 'fasilitas');
        $data = [
            'fasilitas' => $fasilitas,
            'pageTitle' => "Fasilitas Hardware",
            'pager' => $hardwareModel->pager,
        ];

        return view('pengolahan_lab/fasilitas', $data);
    }

    public function delete_hardware($id)
    {
        $hardwareModel = new fasilitas_hardwareModel();
        $hardwareModel->delete(['id' => $id]);
        return redirect()->to('admin/pengolahan_lab');
    }

    public function software()
    {
        $fasilitas = new fasilitas_softwareModel();
        $f_software = $fasilitas->paginate(10, 'f_software');
        $data = [
            'f_software' => $f_software,
            'pageTitle' => "Fasilitas Software",
            'pager' => $fasilitas->pager,
        ];

        return view('pengolahan_lab/f_software', $data);
    }
    public function delete_software($id)
    {
        $fasilitas = new fasilitas_softwareModel();
        $fasilitas->delete(['id' => $id]);
        return redirect()->to('admin/fasilitas');
    }

    public function edit_hardware($id)
    {
        $hardwareModel = new fasilitas_hardwareModel;
        $data = [
            'pageTitle' => 'Hardware',
            'hardware' => $hardwareModel->where('id', $id)->first()
        ];

        return view('pengolahan_lab/edit_data_hardware', $data);
    }

    public function update_hardware($id)
    {
        $hardwareModel = new fasilitas_hardwareModel;
        $data = $this->request->getPost();
        $hardwareModel->update($id, $data);

        return redirect()->to('admin/pengolahan_lab');

    }

    public function edit_software($id)
    {
        $softwareModel = new fasilitas_softwareModel;
        $data = [
            'pageTitle' => 'software',
            'software' => $softwareModel->where('id', $id)->first()
        ];

        return view('pengolahan_lab/edit_data_software', $data);
    }

    public function update_software($id)
    {
        $softwareModel = new fasilitas_softwareModel;
        $data = $this->request->getPost();
        $softwareModel->update($id, $data);
        return redirect()->to('admin/fasilitas');

    }

    public function add_data_hardware()
    {
        $hardwareModel = new fasilitas_hardwareModel;
        return view('pengolahan_lab/add_data_hardware');
    }

    public function save_data_hardware()
    {
        $hardwareModel = new fasilitas_hardwareModel;
        $hardwareModel->insert($this->request->getPost());
        return redirect()->to('admin/pengolahan_lab');
    }

    public function add_data_software()
    {
        $softwareModel = new fasilitas_softwareModel;
        return view('pengolahan_lab/add_data_software');
    }

    public function save_data_software()
    {
        $softwareModel = new fasilitas_softwareModel;
        $softwareModel->insert($this->request->getPost());
        return redirect()->to('pengolahan_lab');
    }
    public function ruangan()
    {
        $fasilitas = new RuanganModel();
        $ruangan = $fasilitas->paginate(10, 'ruangan');
        $data = [
            'ruangan' => $ruangan,
            'pageTitle' => "Ruangan",
            'pager' => $fasilitas->pager,
        ];

        return view('pengolahan_lab/ruangan', $data);
    }

    public function edit_ruangan($id_ruangan)
    {
        $ruanganModel = new RuanganModel;
        $data = [
            'pageTitle' => 'ruangan',
            'ruangan' => $ruanganModel->where('id_ruangan', $id_ruangan)->first()
        ];

        return view('pengolahan_lab/edit_data_ruangan', $data);
    }

    public function update_ruangan($id_ruangan)
    {
        $ruanganModel = new RuanganModel;
        $data = $this->request->getPost();
        $ruanganModel->update($id_ruangan, $data);
        return redirect()->to('admin/fasilitas');

    }

    public function add_data_ruangan()
    {
        $ruanganModel = new ruanganModel;
        return view('pengolahan_lab/add_data_ruangan');
    }

    public function save_data_ruangan()
    {
        $ruanganModel = new RuanganModel;
        $rules = $this->validate([
            'nama_ruangan' => [
                'rules' => 'required|max_length[40]',
                'errors' => [
                    'required' => ' nama ruangan tidak boleh kosong',
                    'max_length[40]' => 'Nama Terlalu Panjang',
                ]
            ],
            'keterangan' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'keterangan di perlukan',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'lokasi' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'lokasi tidak boleh kosong!',
                    'min_length' => 'terlalu pendek'
                ]
            ]
        ]);

        if (!$rules) {
            return view('pengolahan_lab/add_data_ruangan', [
                'pageTitle' => 'Tambah Data',
                'validation' => $this->validator
            ]);

        } else {
            $ruanganModel->insert($this->request->getPost());
            return redirect()->to('admin/ruangan');
        }
    }

    public function delete_ruangan($id_nama)
    {
        $ruanganModel = new RuanganModel();
        $ruanganModel->delete(['id_nama' => $id_nama]);
        return redirect()->to('admin/ruangan');
    }




    public function barang()
    {
        $fasilitas = new barangModel();
        $barang = $fasilitas->paginate(10, 'barang');
        $data = [
            'barang' => $barang,
            'pageTitle' => "Data Barang",
            'pager' => $fasilitas->pager,
        ];

        return view('pengolahan_lab/barang', $data);
    }

    public function delete_barang($id_aset)
    {
        $barangModel = new barangModel();
        $barangModel->delete(['id_aset' => $id_aset]);
        return redirect()->to('admin/barang');
    }

    public function edit_barang($id_aset)
    {
        $barangModel = new barangModel;
        $data = [
            'pageTitle' => 'barang',
            'barang' => $barangModel->where('id_aset', $id_aset)->first()
        ];

        return view('pengolahan_lab/edit_data_barang', $data);
    }

    public function update_barang($id_aset)
    {
        $barangModel = new barangModel;
        $data = $this->request->getPost();
        $barangModel->update($id_aset, $data);
        return redirect()->to('admin/barang');

    }

    public function add_data_barang()
    {
        $galeriModel = new galeriModel;
        return view('pengolahan_lab/add_data_barang');
    }

    public function save_data_barang()
    {
        $barangModel = new barangModel;
        $barangModel->insert($this->request->getPost());
        return redirect()->to('admin/barang');
    }


    public function galeri()
    {
        $fasilitas = new galeriModel();
        $galeri = $fasilitas->joinRuangan()->paginate(10, 'galeri');
        $data = [
            'galeri' => $galeri,
            'pageTitle' => "Galeri",
            'pager' => $fasilitas->pager,

        ];

        return view('pengolahan_lab/galeri', $data);

    }

    public function delete_galeri($id_galeri)
    {
        $galeriModel = new galeriModel();
        $galeriModel->delete(['id_galeri' => $id_galeri]);
        return redirect()->to('admin/galeri');
    }

    public function edit_galeri($id_galeri)
    {
        $galeriModel = new galeriModel();
        $ruanganModel = new RuanganModel();
        $data = [
            'pageTitle' => 'galeri',
            'galeri' => $galeriModel->where('id_galeri', $id_galeri)->first(),
            'ruangan' => $ruanganModel->findAll()
        ];

        return view('pengolahan_lab/edit_data_galeri', $data);
    }

    public function update_galeri($id_galeri)
    {
        $galeriModel = new galeriModel;
        $data = $this->request->getPost();
        $galeriModel->update($id_galeri, $data);
        return redirect()->to('admin/galeri');

    }

    public function add_data_galeri()
    {
        $galeriModel = new galeriModel;
        return view('pengolahan_lab/add_data_galeri');
    }

    public function save_data_galeri()
    {
        $galeriModel = new galeriModel;
        $galeriModel->insert($this->request->getPost());
        return redirect()->to('admin/galeri');
    }

}