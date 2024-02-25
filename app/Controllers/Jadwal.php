<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JamModel;
use App\Models\RuanganModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JadwalModel;
use App\Models\th_ajarModel;


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


    public function reguler_jadwal()
    {
        $jadwalModel = new JadwalModel();

        // Fetch required data from the model
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
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
            'jumlahLab' => $jumlahLab, // Pass the calculated value to the view
        ];

        return view('users-jadwal/v_jadwal', $data);
    }

    public function add_jadwal()
    {
        $jadwalModel = new JadwalModel();
        $ruangan = new RuanganModel();
        $jam = new JamModel();
        $hari = $jadwalModel->getHari();


        $data = [
            'ruangan' => $ruangan->findAll(),
            'jam' => $jam->findAll(),
            'hari' => $hari,
            'tahun' => $jadwalModel->data_thn(),
        ];

        return view('users-jadwal/add_jadwal', $data);
    }


    public function save_jadwal()
    {
        $db = \Config\Database::connect();
        // Ambil data dari request
        $mk = $this->request->getPost('mk');
        $kelas = $this->request->getPost('kelas');
        $hari = $this->request->getPost('hari');
        $id_ruangan = $this->request->getPost('nama_ruangan');
        $jam = $this->request->getPost('jam');
        $nama_dosen = $this->request->getPost('dosen');
        $jenis = "REGULER";
        $id_thn = 2;
        $id_prodi = $this->request->getPost('prodi');

        // // **Validasi**
        // $validasi = $this->validate([
        //     'mk' => 'required',
        //     'kelas' => 'required',
        //     'hari' => 'required',
        //     'nama_ruangan' => 'required',
        //     'jam' => 'required',
        //     'dosen' => 'required',
        // ]);

        // // Jika validasi gagal, tampilkan pesan error
        // if (!$validasi) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }

        // Join tabel jadwal dan jadwal_detail
        $cekKelas = $db->table('jadwal')
            ->join('jadwal_detail', 'jadwal.id_jadwal = jadwal_detail.id_jadwal')
            ->where('jadwal.hari', $hari)
            ->where('jadwal.id_ruangan', $id_ruangan)
            ->where('jadwal_detail.id_jam', $jam)
            ->where('jadwal.jenis', 'REGULER')
            ->get()
            ->getResult();

        // ... (proses selanjutnya) ...

        // Jika ada kelas di jam dan ruangan yang sama, tampilkan pesan error
        if (!empty($cekKelas)) {
            return redirect()->back()->with('errors', 'Ruangan dan jam tersebut sudah terisi kelas lain.')->withInput();
        }

        // Panggil metode di model untuk menyimpan jadwal
        $modelJadwal = new JadwalModel();
        $modelJadwal->simpan_jadwalreguler($mk, $kelas, $id_ruangan, $jam, $nama_dosen, $jenis, $id_thn, $hari, $id_prodi);

        // Data berhasil disimpan
        return redirect()->to('admin/jadwal-user');
    }






}
