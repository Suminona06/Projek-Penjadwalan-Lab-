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

        return view('jadwal/jadwal-reguler', $data);
    }
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
