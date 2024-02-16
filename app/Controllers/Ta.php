<?php

namespace App\Controllers;

use App\Models\th_ajarModel;
use App\Models\jurusanModel;
use App\Models\prodiModel;
use App\Models\unitModel;

class Ta extends BaseController
{
    public function index()
    {
        $thjrModel = new th_ajarModel();
        $ta = $thjrModel->paginate(10, 'ta');
        $data = [
            'ta' => $ta,
            'pageTitle' => "Tahun Ajaran",
            'pager' => $thjrModel->pager,
        ];



        return view('data_akademik/ta', $data);
    }

    public function add_data_ta()
    {
        $thjrModel = new th_ajarModel;
        return view('data_akademik/add_data_ta');
    }

    public function save_data_ta()
    {
        $thjrModel = new th_ajarModel;
        // $data = [
        // 'thn_awal' => $this->request->getPost('thn_awal'),
        // 'thn_akhir' => $this->request->getPost('thn_akhir'),
        // 'semester' => $this->request->getPost('semester'),
        // ];
        $thjrModel->insert($this->request->getPost());
        return redirect()->to('admin/data_akademik');
    }

    public function toggleStatus($id_thn)
    {
        $th_ajarModel = new th_ajarModel();
        $ta = $th_ajarModel->find($id_thn);

        // Ambil semua tahun ajaran
        $all_ta = $th_ajarModel->findAll();

        // Nonaktifkan semua tahun ajaran kecuali yang saat ini diaktifkan
        foreach ($all_ta as $tahun) {
            if ($tahun['id_thn'] != $ta['id_thn']) { // Perhatikan perubahan di sini
                $tahun['status'] = 'TIDAK';
                $th_ajarModel->save($tahun);
            }
        }

        // Aktifkan atau nonaktifkan tahun ajaran yang dipilih
        if ($ta['status'] == 'AKTIF') {
            $ta['status'] = 'TIDAK'; // Jika aktif, maka ubah menjadi tidak aktif
        } else {
            $ta['status'] = 'AKTIF'; // Jika tidak aktif, maka ubah menjadi aktif
        }

        $th_ajarModel->save($ta);

        return redirect()->to('/admin/data_akademik');
    }




    public function jurusan()
    {
        $ta = new jurusanModel();
        $jurusan = $ta->paginate(10, 'jurusan');
        $data = [
            'jurusan' => $jurusan,
            'pageTitle' => "Jurusan",
            'pager' => $ta->pager,
        ];

        return view('data_akademik/jurusan', $data);
    }

    public function add_data_jurusan()
    {
        $jurusanModel = new jurusanModel;
        return view('data_akademik/add_data_jurusan');
    }

    public function save_data_jurusan()
    {
        $jurusanModel = new jurusanModel;
        $jurusanModel->insert($this->request->getPost());
        return redirect()->to('admin/jurusan');
    }

    public function edit_jurusan($id_jurusan)
    {
        $jurusanModel = new jurusanModel;
        $data = [
            'pageTitle' => 'jurusan',
            'jurusan' => $jurusanModel->where('id_jurusan', $id_jurusan)->first()
        ];

        return view('data_akademik/edit_data_jurusan', $data);
    }

    public function update_jurusan($id_jurusan)
    {
        $jurusanModel = new jurusanModel;
        $data = $this->request->getPost();
        $jurusanModel->update($id_jurusan, $data);
        return redirect()->to('admin/jurusan');
    }

    public function delete_jurusan($id_jurusan)
    {
        $jurusanModel = new jurusanModel();
        $jurusanModel->delete(['id_jurusan' => $id_jurusan]);
        return redirect()->to('admin/jurusan');
    }


    public function prodi()
    {
        $ta = new prodiModel();
        $prodi = $ta->joinJurusan()->paginate(10, 'prodi');
        $data = [
            'prodi' => $prodi,
            'pageTitle' => "Prodi",
            'pager' => $ta->pager,
        ];

        return view('data_akademik/prodi', $data);
    }

    public function add_data_prodi()
    {
        $prodiModel = new prodiModel;
        $jurusanModel = new jurusanModel();

        $data = [
            'pageTitle' => 'prodi',
            'prodi' => $prodiModel->find('id_jurusan'),
            'jurusan' => $jurusanModel->findAll()

        ];

        return view('data_akademik/add_data_prodi', $data);
    }

    public function save_data_prodi()
    {


        // Ambil data dari form
        $postData = $this->request->getPost();

        // Validasi data jika diperlukan

        // Simpan data program studi
        $prodiModel = new prodiModel();
        $jurusanModel = new jurusanModel();

        // Pastikan id_jurusan yang dikirim valid
        if ($jurusanModel->find($postData['id_jurusan'])) {
            // Jika id_jurusan valid, simpan data program studi
            $prodiModel->insert($postData);
            return redirect()->to('admin/prodi');
        }
    }

    public function edit_prodi($id_prodi)
    {
        $prodiModel = new ProdiModel();
        $jurusanModel = new JurusanModel();

        $prodi = $prodiModel->find($id_prodi);

        if (!$prodi) {
            return redirect()->to('/admin/prodi')->with('error', 'Data prodi tidak ditemukan.');
        }

        $data = [
            'pageTitle' => 'Edit Data Prodi',
            'prodi' => $prodi,
            'jurusan' => $jurusanModel->findAll()
        ];

        return view('data_akademik/edit_data_prodi', $data);
    }

    public function update_prodi($id_prodi)
    {
        $prodiModel = new ProdiModel();
        $jurusanModel = new JurusanModel();

        $prodi = $prodiModel->find($id_prodi);

        if (!$prodi) {
            return redirect()->to('/admin/prodi')->with('error', 'Data prodi tidak ditemukan.');
        }

        // Ambil data dari form
        $postData = $this->request->getPost();

        // Validasi data jika diperlukan

        // Pastikan id_jurusan yang dikirim valid
        if (!$jurusanModel->find($postData['id_jurusan'])) {
            return redirect()->back()->withInput()->with('error', 'Jurusan tidak valid.');
        }

        // Update data prodi
        $prodiModel->update($id_prodi, $postData);

        return redirect()->to('/admin/prodi')->with('success', 'Data prodi berhasil diperbarui.');
    }

    public function delete_prodi($id)
    {
        $prodiModel = new ProdiModel();

        $prodi = $prodiModel->find($id);

        if (!$prodi) {
            return redirect()->to('/admin/prodi')->with('error', 'Data prodi tidak ditemukan.');
        }

        // Hapus data prodi
        $prodiModel->delete($id);

        return redirect()->to('/admin/prodi')->with('success', 'Data prodi berhasil dihapus.');
    }


    public function unit()
    {
        $ta = new unitModel();
        $unit = $ta->paginate(10, 'unit');
        $data = [
            'unit' => $unit,
            'pageTitle' => "Unit",
            'pager' => $ta->pager,
        ];

        return view('data_akademik/unit', $data);
    }

    public function add_data_unit()
    {
        $unitModel = new unitModel;
        return view('data_akademik/add_data_unit');
    }

    public function save_data_unit()
    {
        $unitModel = new unitModel;
        $unitModel->insert($this->request->getPost());
        return redirect()->to('admin/unit');
    }

    public function edit_unit($id_unit)
    {
        $unitModel = new unitModel;
        $data = [
            'pageTitle' => 'Unit',
            'unit' => $unitModel->where('id_unit', $id_unit)->first()
        ];

        return view('data_akademik/edit_data_unit', $data);
    }

    public function update_unit($id_unit)
    {
        $unitModel = new unitModel;
        $data = $this->request->getPost();
        $unitModel->update($id_unit, $data);
        return redirect()->to('admin/unit');
    }

    public function delete_unit($id_unit)
    {
        $unitModel = new unitModel();
        $unitModel->delete(['id_unit' => $id_unit]);
        return redirect()->to('admin/unit');
    }
}
