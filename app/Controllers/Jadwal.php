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


    // view jadwal

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



    //Views non reguler
    public function nonReguler_jadwal()
    {
        $jadwalModel = new JadwalModel();

        // Fetch required data from the model
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
        $hari = $jadwalModel->getHari();
        $jam = $jadwalModel->getJam();
        $ruangan = $jadwalModel->getRuangan();
        $jadwal = $jadwalModel->getJadwalNonReguler();

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

        return view('users-jadwal/v_nonreguler', $data);
    }

    //view uas
    public function jadwal_UAS()
    {
        $jadwalModel = new JadwalModel();

        // Fetch required data from the model
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
        $hari = $jadwalModel->getHari();
        $jam = $jadwalModel->getJam();
        $ruangan = $jadwalModel->getRuangan();
        $jadwal = $jadwalModel->getJadwalUAS();

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

        return view('users-jadwal/v_uas', $data);
    }

    public function jadwal_UTS()
    {
        $jadwalModel = new JadwalModel();

        // Fetch required data from the model
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
        $hari = $jadwalModel->getHari();
        $jam = $jadwalModel->getJam();
        $ruangan = $jadwalModel->getRuangan();
        $jadwal = $jadwalModel->getJadwalUTS();

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

        return view('users-jadwal/v_uts', $data);
    }


    //Add Jadwal

    public function add_jadwal()
    {
        $jadwalModel = new JadwalModel();
        $ruangan = new RuanganModel();
        $jam = new JamModel();
        $hari = $jadwalModel->getHari();


        $data = [
            'ruangan' => $ruangan->findAll(),
            'hari' => $hari,
            'tahun' => $jadwalModel->data_thn(),
            'jam' => $jam->findAll()
        ];

        return view('users-jadwal/add_jadwal', $data);
    }

    // add table nonreguler
    public function add_nonreguler()
    {
        $jadwalModel = new JadwalModel();
        $ruangan = new RuanganModel();
        $jam = new JamModel();
        $hari = $jadwalModel->getHari();


        $data = [
            'ruangan' => $ruangan->findAll(),
            'hari' => $hari,
            'tahun' => $jadwalModel->data_thn(),
            'jam' => $jam->findAll()
        ];

        return view('users-jadwal/add_nonreguler', $data);
    }
    public function add_uas()
    {
        $jadwalModel = new JadwalModel();
        $ruangan = new RuanganModel();
        $jam = new JamModel();
        $hari = $jadwalModel->getHari();


        $data = [
            'ruangan' => $ruangan->findAll(),
            'hari' => $hari,
            'tahun' => $jadwalModel->data_thn(),
            'jam' => $jam->findAll()
        ];

        return view('users-jadwal/add_uas', $data);
    }

    public function add_uts()
    {
        $jadwalModel = new JadwalModel();
        $ruangan = new RuanganModel();
        $jam = new JamModel();
        $hari = $jadwalModel->getHari();


        $data = [
            'ruangan' => $ruangan->findAll(),
            'hari' => $hari,
            'tahun' => $jadwalModel->data_thn(),
            'jam' => $jam->findAll()
        ];

        return view('users-jadwal/add_uts', $data);
    }

    public function save_nonReguler()
    {
        $db = \Config\Database::connect();

        // Ambil data dari request
        $mk = $this->request->getPost('mk');
        $kelas = $this->request->getPost('kelas');
        $hari = $this->request->getPost('hari');
        $id_ruangan = $this->request->getPost('nama_ruangan');
        $jam = $this->request->getPost('jam');
        $nama_dosen = $this->request->getPost('dosen');
        $jenis = "NONREGULER";
        $id_thn = 2;
        $id_prodi = $this->request->getPost('prodi');

        // Validasi
        $validasi = $this->validate([
            'mk' => 'required',
            'kelas' => 'required',
            'hari' => 'required',
            'nama_ruangan' => 'required',
            'dosen' => 'required',
        ]);

        // Jika validasi gagal, tampilkan pesan error
        if (!$validasi) {
            return redirect()->back()->withInput()->with('fail', $this->validator->getErrors());
        }

        // Join tabel jadwal dan jadwal_detail
        $cekKelas = $db->table('jadwal')
            ->join('jadwal_detail', 'jadwal.id_jadwal = jadwal_detail.id_jadwal')
            ->where('jadwal.hari', $hari)
            ->where('jadwal.id_ruangan', $id_ruangan)
            ->whereIn('jadwal_detail.id_jam', $jam)
            ->where('jadwal.jenis', 'NONREGULER')
            ->get()
            ->getResult();

        // Jika ada kelas di jam dan ruangan yang sama, tampilkan pesan error
        if (!empty($cekKelas)) {
            return redirect()->back()->with('errors', 'Ruangan dan jam tersebut sudah terisi kelas lain.')->withInput();
        }

        // Panggil metode di model untuk menyimpan jadwal
        $modelJadwal = new JadwalModel();
        $modelJadwal->simpan_jadwalnonreguler($mk, $kelas, $id_ruangan, $jam, $nama_dosen, $jenis, $id_thn, $hari, $id_prodi);

        // Data berhasil disimpan
        return redirect()->to('admin/jadwal-nonreguler');
    }


    //Simpan Jadwal reguler
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

        // Validasi
        $validasi = $this->validate([
            'mk' => 'required',
            'kelas' => 'required',
            'hari' => 'required',
            'nama_ruangan' => 'required',
            'dosen' => 'required',
        ]);

        // Jika validasi gagal, tampilkan pesan error
        if (!$validasi) {
            return redirect()->back()->withInput()->with('fail', $this->validator->getErrors());
        }

        // Join tabel jadwal dan jadwal_detail
        $cekKelas = $db->table('jadwal')
            ->join('jadwal_detail', 'jadwal.id_jadwal = jadwal_detail.id_jadwal')
            ->where('jadwal.hari', $hari)
            ->where('jadwal.id_ruangan', $id_ruangan)
            ->whereIn('jadwal_detail.id_jam', $jam)
            ->where('jadwal.jenis', 'REGULER')
            ->get()
            ->getResult();

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


    public function save_uas()
    {
        $db = \Config\Database::connect();

        // Ambil data dari request
        $mk = $this->request->getPost('mk');
        $kelas = $this->request->getPost('kelas');
        $hari = $this->request->getPost('hari');
        $id_ruangan = $this->request->getPost('nama_ruangan');
        $jam = $this->request->getPost('jam');
        $nama_dosen = $this->request->getPost('dosen');
        $jenis = "UAS";
        $id_thn = 2;
        $id_prodi = $this->request->getPost('prodi');

        // Validasi
        $validasi = $this->validate([
            'mk' => 'required',
            'kelas' => 'required',
            'hari' => 'required',
            'nama_ruangan' => 'required',
            'dosen' => 'required',
        ]);

        // Jika validasi gagal, tampilkan pesan error
        if (!$validasi) {
            return redirect()->back()->withInput()->with('fail', $this->validator->getErrors());
        }

        // Join tabel jadwal dan jadwal_detail
        $cekKelas = $db->table('jadwal')
            ->join('jadwal_detail', 'jadwal.id_jadwal = jadwal_detail.id_jadwal')
            ->where('jadwal.hari', $hari)
            ->where('jadwal.id_ruangan', $id_ruangan)
            ->whereIn('jadwal_detail.id_jam', $jam)
            ->where('jadwal.jenis', 'UAS')
            ->get()
            ->getResult();

        // Jika ada kelas di jam dan ruangan yang sama, tampilkan pesan error
        if (!empty($cekKelas)) {
            return redirect()->back()->with('errors', 'Ruangan dan jam tersebut sudah terisi kelas lain.')->withInput();
        }

        // Panggil metode di model untuk menyimpan jadwal
        $modelJadwal = new JadwalModel();
        $modelJadwal->simpan_jadwaluas($mk, $kelas, $id_ruangan, $jam, $nama_dosen, $jenis, $id_thn, $hari, $id_prodi);

        // Data berhasil disimpan
        return redirect()->to('admin/jadwal-uas');
    }


    public function save_uts()
    {
        $db = \Config\Database::connect();

        // Ambil data dari request
        $mk = $this->request->getPost('mk');
        $kelas = $this->request->getPost('kelas');
        $hari = $this->request->getPost('hari');
        $id_ruangan = $this->request->getPost('nama_ruangan');
        $jam = $this->request->getPost('jam');
        $nama_dosen = $this->request->getPost('dosen');
        $jenis = "UTS";
        $id_thn = 2;
        $id_prodi = $this->request->getPost('prodi');

        // Validasi
        $validasi = $this->validate([
            'mk' => 'required',
            'kelas' => 'required',
            'hari' => 'required',
            'nama_ruangan' => 'required',
            'dosen' => 'required',
        ]);

        // Jika validasi gagal, tampilkan pesan error
        if (!$validasi) {
            return redirect()->back()->withInput()->with('fail', $this->validator->getErrors());
        }

        // Join tabel jadwal dan jadwal_detail
        $cekKelas = $db->table('jadwal')
            ->join('jadwal_detail', 'jadwal.id_jadwal = jadwal_detail.id_jadwal')
            ->where('jadwal.hari', $hari)
            ->where('jadwal.id_ruangan', $id_ruangan)
            ->whereIn('jadwal_detail.id_jam', $jam)
            ->where('jadwal.jenis', 'UTS')
            ->get()
            ->getResult();

        // Jika ada kelas di jam dan ruangan yang sama, tampilkan pesan error
        if (!empty($cekKelas)) {
            return redirect()->back()->with('errors', 'Ruangan dan jam tersebut sudah terisi kelas lain.')->withInput();
        }

        // Panggil metode di model untuk menyimpan jadwal
        $modelJadwal = new JadwalModel();
        $modelJadwal->simpan_jadwaluts($mk, $kelas, $id_ruangan, $jam, $nama_dosen, $jenis, $id_thn, $hari, $id_prodi);

        // Data berhasil disimpan
        return redirect()->to('admin/jadwal-uts');
    }


    public function getJamByRuangan()
    {
        $id_ruangan = $this->request->getPost('id_ruangan');
        $hari = (array) $this->request->getPost('hari');

        $db = \Config\Database::connect();

        $query = $db->table('jam')
            ->select('jam.id, jam.jam')
            ->get();

        $jam = $query->getResultArray();

        $jamSudahDipilih = [];
        foreach ($jam as $j) {
            $jadwal = $db->table('jadwal_detail')
                ->join('jadwal', 'jadwal.id_jadwal = jadwal_detail.id_jadwal')
                ->where('jadwal_detail.id_jam', $j['id'])
                ->where('jadwal.id_ruangan', $id_ruangan)
                ->where('jadwal.jenis', 'NONREGULER')
                ->whereIn('jadwal.hari', $hari)
                ->get()
                ->getRowArray();

            if ($jadwal) {
                $jamSudahDipilih[] = $j['id'];
            }
        }

        foreach ($jam as &$j) {
            $j['sudah_dipilih'] = in_array($j['id'], $jamSudahDipilih);
        }

        echo json_encode($jam);
    }

    public function getJamByRuangan3()
    {
        $id_ruangan = $this->request->getPost('id_ruangan');
        $hari = (array) $this->request->getPost('hari');

        $db = \Config\Database::connect();

        $query = $db->table('jam')
            ->select('jam.id, jam.jam')
            ->get();

        $jam = $query->getResultArray();

        $jamSudahDipilih = [];
        foreach ($jam as $j) {
            $jadwal = $db->table('jadwal_detail')
                ->join('jadwal', 'jadwal.id_jadwal = jadwal_detail.id_jadwal')
                ->where('jadwal_detail.id_jam', $j['id'])
                ->where('jadwal.id_ruangan', $id_ruangan)
                ->where('jadwal.jenis', 'REGULER')
                ->whereIn('jadwal.hari', $hari)
                ->get()
                ->getRowArray();

            if ($jadwal) {
                $jamSudahDipilih[] = $j['id'];
            }
        }

        foreach ($jam as &$j) {
            $j['sudah_dipilih'] = in_array($j['id'], $jamSudahDipilih);
        }

        echo json_encode($jam);
    }


    public function getJamByRuangan1()
    {
        $id_ruangan = $this->request->getPost('id_ruangan');
        $hari = (array) $this->request->getPost('hari');

        $db = \Config\Database::connect();

        $query = $db->table('jam')
            ->select('jam.id, jam.jam')
            ->get();

        $jam = $query->getResultArray();

        $jamSudahDipilih = [];
        foreach ($jam as $j) {
            $jadwal = $db->table('jadwal_detail')
                ->join('jadwal', 'jadwal.id_jadwal = jadwal_detail.id_jadwal')
                ->where('jadwal_detail.id_jam', $j['id'])
                ->where('jadwal.id_ruangan', $id_ruangan)
                ->where('jadwal.jenis', 'UAS')
                ->whereIn('jadwal.hari', $hari)
                ->get()
                ->getRowArray();

            if ($jadwal) {
                $jamSudahDipilih[] = $j['id'];
            }
        }

        foreach ($jam as &$j) {
            $j['sudah_dipilih'] = in_array($j['id'], $jamSudahDipilih);
        }

        echo json_encode($jam);
    }


    public function getJamByRuangan2()
    {
        $id_ruangan = $this->request->getPost('id_ruangan');
        $hari = (array) $this->request->getPost('hari');

        $db = \Config\Database::connect();

        $query = $db->table('jam')
            ->select('jam.id, jam.jam')
            ->get();

        $jam = $query->getResultArray();

        $jamSudahDipilih = [];
        foreach ($jam as $j) {
            $jadwal = $db->table('jadwal_detail')
                ->join('jadwal', 'jadwal.id_jadwal = jadwal_detail.id_jadwal')
                ->where('jadwal_detail.id_jam', $j['id'])
                ->where('jadwal.id_ruangan', $id_ruangan)
                ->where('jadwal.jenis', 'UTS')
                ->whereIn('jadwal.hari', $hari)
                ->get()
                ->getRowArray();

            if ($jadwal) {
                $jamSudahDipilih[] = $j['id'];
            }
        }

        foreach ($jam as &$j) {
            $j['sudah_dipilih'] = in_array($j['id'], $jamSudahDipilih);
        }

        echo json_encode($jam);
    }







}
