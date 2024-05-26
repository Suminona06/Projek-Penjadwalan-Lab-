<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JamModel;
use App\Models\RuanganModel;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\JadwalModel;
use App\Models\th_ajarModel;

class JadwalAdmin extends BaseController
{
    // <-----------------------ADMIN JADWAL------------>
    public function index()
    {
        $jadwalModel = new JadwalModel();

        // Ambil keyword dari request atau dari session jika ada
        $keyword = $this->request->getPost('keyword') ?? session('jadwal_keyword');

        // Simpan keyword dalam session
        session()->set('jadwal_keyword', $keyword);

        // Query dasar dengan join
        $query = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', 'REGULER');

        // Terapkan filter pencarian berdasarkan keyword
        if ($keyword) {
            // Jika keyword adalah nama ruangan, gunakan like untuk mencari kesesuaian sebagian dari nama ruangan
            $query->groupStart()
                ->like('hari', $keyword)
                ->orLike('nama_dosen', $keyword)
                ->orLike('mk', $keyword)
                ->orLike('kelas', $keyword)
                ->orGroupStart()
                ->like('nama_ruangan', $keyword) // Memastikan nama ruangan mengandung substring yang dicari
                ->orLike('nama_ruangan', str_replace(' ', '%', $keyword)) // Menangani kasus di mana kata kunci terdiri dari beberapa kata
                ->groupEnd()
                ->orGroupStart()
                ->like('nama_prodi', $keyword) // Memastikan nama ruangan mengandung substring yang dicari
                ->orLike('nama_prodi', str_replace(' ', '%', $keyword)) // Menangani kasus di mana kata kunci terdiri dari beberapa kata
                ->groupEnd()
                ->groupEnd();
        }

        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jam = new JamModel();
        // Melakukan paginate pada hasil query
        $result = $query->paginate(10, 'jadwal');

        // Ambil pager setelah menjalankan metode paginate
        $pager = $jadwalModel->pager;

        // Siapkan data untuk views
        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $result,
            'pager' => $pager, // Kirim pager ke view
            'keyword' => $keyword,
            'hari' => $hari,
            'jam' => $jam->findAll() // Kirim keyword kembali ke view
        ];

        return view('jadwal/jadwal-reguler', $data);
    }



    public function edit_reguler($id_jadwal)
    {
        // Simpan URL referer ke dalam session
        $session = session();
        $session->setFlashdata('referrer', $_SERVER['HTTP_REFERER']);

        $jadwalmodel = new JadwalModel();
        $ruanganModel = new RuanganModel();
        $jadwal = $jadwalmodel->joinRuangan()->joinTA()->joinProdi()->joinJam1();
        $tahun = $jadwalmodel->data_thn();

        $data = [
            'pageTitle' => 'jadwal',
            'jadwal' => $jadwal->where('jadwal.id_jadwal', $id_jadwal)->first(),
            'ruangan' => $ruanganModel->findAll(),
            'tahun' => $tahun
        ];

        return view('jadwal/edit-reguler', $data);
    }


    public function getJamByRuangan()
    {
        $id_ruangan = $this->request->getPost('id_ruangan');
        $tahun = $this->request->getPost('tahun');
        $jenis = $this->request->getPost('jenis');
        $hari = $this->request->getPost('hari');

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
                ->where('jadwal.id_thn', $tahun)
                ->where('jadwal.jenis', $jenis)
                ->where('jadwal.hari', $hari)
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



    public function update_reguler($id_jadwal)
    {
        $jadwalmodel = new JadwalModel();
        $rules = $this->validate([
            'mk' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'gambar di perlukan',
                    'max_length' => 'terlalu panjang!'
                ]
            ],
            'nama_dosen' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'nama di perlukan',
                    'min_length' => 'terlalu pendek!'
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kelas di perlukan',
                ]
            ],
            'jam' => [
                'rules' => 'required',
                'errors' => 'jam harus di isi'
            ],
            'nama_prodi' => [
                'rules' => 'required',
                'errors' => 'prodi harus di isi'
            ],
            'nama_ruangan' => [
                'rules' => 'required',
                'errors' => 'nama ruangan harus di isi'
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => 'jenis harus di isi'
            ],
            'hari' => [
                'rules' => 'required',
                'errors' => 'hari harus di isi'
            ],
        ]);

        $session = session();
        $referrer = $session->getFlashdata('referrer');

        if (!$rules) {
            $jadwalmodel = new JadwalModel();
            $ruanganModel = new RuanganModel();
            $jadwal = $jadwalmodel->joinRuangan()->joinTA()->joinProdi()->joinJam1()->where('jadwal.id_jadwal', $id_jadwal)->first();
            $data = [
                'pageTitle' => 'software',
                'jadwal' => $jadwal,
                'ruangan' => $ruanganModel->findAll(),
                'validation' => $this->validator
            ];

            return view('jadwal/edit-reguler', $data);
        } // Jika URL referer ada dan merupakan string, arahkan pengguna kembali ke URL referer
        if ($referrer && is_string($referrer)) {
            // Ambil data dari request
            $mk = $this->request->getPost('mk');
            $kelas = $this->request->getPost('kelas');
            $hari = $this->request->getPost('hari');
            $id_ruangan = $this->request->getPost('nama_ruangan');
            $jam = $this->request->getPost('jam');
            $nama_dosen = $this->request->getPost('dosen');
            $jenis = "UTS";
            $id_thn = $this->request->getPost('tahun');
            $id_prodi = $this->request->getPost('prodi');

            $jadwalmodel->update_jadwal($id_jadwal, $mk, $kelas, $id_ruangan, $jam, $nama_dosen, $jenis, $id_thn, $hari, $id_prodi);

            return redirect()->to($referrer)->with('success', 'Data berhasil diubah.');
        } else {
            // Jika tidak ada URL referer, arahkan pengguna ke halaman jadwal
            return redirect()->to('admin/jadwal')->with('success', 'Data berhasil diubah.');
        }


    }



    // ---------------ADMIN JADWAL NON REGULER ------------------------
    public function jadwalNonReguler()
    {
        $jadwalModel = new JadwalModel();

        // Ambil keyword dari request atau dari session jika ada
        $keyword = $this->request->getPost('keyword') ?? session('jadwal_keyword');

        // Simpan keyword dalam session
        session()->set('jadwal_keyword', $keyword);

        // Query dasar dengan join
        $query = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', 'NONREGULER');

        // Terapkan filter pencarian berdasarkan keyword
        if ($keyword) {
            // Pecah keyword menjadi array
            $keywordArr = explode(' ', $keyword);

            // Ekstrak hari dan nama dosen dari array keyword
            $hari = $keywordArr[0] ?? '';
            $nama_dosen = $keywordArr[1] ?? '';

            // Jika ada hari dan nama dosen, terapkan filter
            if ($hari && $nama_dosen) {
                $query->where('hari', $hari)->where('nama_dosen', $nama_dosen);
            } else {
                // Jika tidak ada hari dan nama dosen, gunakan filter berdasarkan keyword
                $query->groupStart()
                    ->like('hari', $keyword)
                    ->orLike('nama_dosen', $keyword)
                    ->orLike('mk', $keyword)
                    ->orLike('nama_prodi', $keyword)
                    ->orLike('nama_ruangan', '%' . $keyword . '%')
                    ->groupEnd();
            }
        }

        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jam = new JamModel();

        // Melakukan paginate pada hasil query
        $result = $query->paginate(10, 'jadwal');

        // Ambil pager setelah menjalankan metode paginate
        $pager = $jadwalModel->pager;

        // Siapkan data untuk view
        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $result,
            'pager' => $pager, // Kirim pager ke view
            'keyword' => $keyword,
            'hari' => $hari,
            'jam' => $jam->findAll() // Kirim keyword kembali ke view
        ];

        return view('jadwal/jadwal-nonreguler', $data);
    }
    public function jadwalUAS()
    {
        $jadwalModel = new JadwalModel();

        // Ambil keyword dari request atau dari session jika ada
        $keyword = $this->request->getPost('keyword') ?? session('jadwal_keyword');

        // Simpan keyword dalam session
        session()->set('jadwal_keyword', $keyword);

        // Query dasar dengan join
        $query = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', 'UAS');

        // Terapkan filter pencarian berdasarkan keyword
        if ($keyword) {
            // Pecah keyword menjadi array
            $keywordArr = explode(' ', $keyword);

            // Ekstrak hari dan nama dosen dari array keyword
            $hari = $keywordArr[0] ?? '';
            $nama_dosen = $keywordArr[1] ?? '';

            // Jika ada hari dan nama dosen, terapkan filter
            if ($hari && $nama_dosen) {
                $query->where('hari', $hari)->where('nama_dosen', $nama_dosen);
            } else {
                // Jika tidak ada hari dan nama dosen, gunakan filter berdasarkan keyword
                $query->groupStart()
                    ->like('hari', $keyword)
                    ->orLike('nama_dosen', $keyword)
                    ->orLike('mk', $keyword)
                    ->orLike('nama_prodi', $keyword)
                    ->orLike('nama_ruangan', '%' . $keyword . '%')
                    ->groupEnd();
            }
        }

        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jam = new JamModel();

        // Melakukan paginate pada hasil query
        $result = $query->paginate(10, 'jadwal');

        // Ambil pager setelah menjalankan metode paginate
        $pager = $jadwalModel->pager;

        // Siapkan data untuk view
        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $result,
            'pager' => $pager, // Kirim pager ke view
            'keyword' => $keyword,
            'hari' => $hari,
            'jam' => $jam->findAll(), // Kirim keyword kembali ke view
        ];

        return view('jadwal/jadwal-uas', $data);
    }
    public function jadwalUTS()
    {
        $jadwalModel = new JadwalModel();

        // Ambil keyword dari request atau dari session jika ada
        $keyword = $this->request->getPost('keyword') ?? session('jadwal_keyword');

        // Simpan keyword dalam session
        session()->set('jadwal_keyword', $keyword);

        // Query dasar dengan join
        $query = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', 'UTS');

        // Terapkan filter pencarian berdasarkan keyword
        if ($keyword) {
            // Pecah keyword menjadi array
            $keywordArr = explode(' ', $keyword);

            // Ekstrak hari dan nama dosen dari array keyword
            $hari = $keywordArr[0] ?? '';
            $nama_dosen = $keywordArr[1] ?? '';

            // Jika ada hari dan nama dosen, terapkan filter
            if ($hari && $nama_dosen) {
                $query->where('hari', $hari)->where('nama_dosen', $nama_dosen);
            } else {
                // Jika tidak ada hari dan nama dosen, gunakan filter berdasarkan keyword
                $query->groupStart()
                    ->like('hari', $keyword)
                    ->orLike('nama_dosen', $keyword)
                    ->orLike('mk', $keyword)
                    ->orLike('nama_prodi', $keyword)
                    ->orLike('nama_ruangan', '%' . $keyword . '%')
                    ->groupEnd();
            }
        }

        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jam = new JamModel();
        // Melakukan paginate pada hasil query
        $result = $query->paginate(10, 'jadwal');

        // Ambil pager setelah menjalankan metode paginate
        $pager = $jadwalModel->pager;

        // Siapkan data untuk view
        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $result,
            'pager' => $pager, // Kirim pager ke view
            'keyword' => $keyword,
            'hari' => $hari,
            'jam' => $jam->findAll() // Kirim keyword kembali ke view
        ];

        return view('jadwal/jadwal-uts', $data);
    }


    public function deleteJadwal($id_jadwal)
    {
        $ruanganModel = new JadwalModel();
        $ruanganModel->delete(['id_jadwal' => $id_jadwal]);
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', 'Data berhasil dihapus.');
    }


}
