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
                ->orLike('nama_prodi', $keyword)
                ->orLike('kelas', $keyword)
                ->orGroupStart()
                ->like('nama_ruangan', $keyword) // Memastikan nama ruangan mengandung substring yang dicari
                ->orLike('nama_ruangan', str_replace(' ', '%', $keyword)) // Menangani kasus di mana kata kunci terdiri dari beberapa kata
                ->groupEnd()
                ->groupEnd();
        }

        // Melakukan paginate pada hasil query
        $result = $query->paginate(10, 'jadwal');

        // Ambil pager setelah menjalankan metode paginate
        $pager = $jadwalModel->pager;

        // Siapkan data untuk view
        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $result,
            'pager' => $pager, // Kirim pager ke view
            'keyword' => $keyword, // Kirim keyword kembali ke view
        ];

        return view('jadwal/jadwal-reguler', $data);
    }



    public function edit_reguler($id_jadwal)
    {
        $jadwalmodel = new JadwalModel();
        $ruanganModel = new RuanganModel();
        $jadwal = $jadwalmodel->joinRuangan()->joinTA()->joinProdi()->joinJam1();
        $data = [
            'pageTitle' => 'jadwal',
            'jadwal' => $jadwal->where('jadwal.id_jadwal', $id_jadwal)->first(),
            'ruangan' => $ruanganModel->findAll()
        ];

        return view('jadwal/edit-reguler', $data);
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
        } else {
            $data = $this->request->getPost();
            $jadwalmodel->update($id_jadwal, $data);
            return redirect()->to('admin/jadwal');

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

        // Melakukan paginate pada hasil query
        $result = $query->paginate(10, 'jadwal');

        // Ambil pager setelah menjalankan metode paginate
        $pager = $jadwalModel->pager;

        // Siapkan data untuk view
        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $result,
            'pager' => $pager, // Kirim pager ke view
            'keyword' => $keyword, // Kirim keyword kembali ke view
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

        // Melakukan paginate pada hasil query
        $result = $query->paginate(10, 'jadwal');

        // Ambil pager setelah menjalankan metode paginate
        $pager = $jadwalModel->pager;

        // Siapkan data untuk view
        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $result,
            'pager' => $pager, // Kirim pager ke view
            'keyword' => $keyword, // Kirim keyword kembali ke view
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

        // Melakukan paginate pada hasil query
        $result = $query->paginate(10, 'jadwal');

        // Ambil pager setelah menjalankan metode paginate
        $pager = $jadwalModel->pager;

        // Siapkan data untuk view
        $data = [
            'pageTitle' => 'Jadwal-reguler',
            'jadwal' => $result,
            'pager' => $pager, // Kirim pager ke view
            'keyword' => $keyword, // Kirim keyword kembali ke view
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
