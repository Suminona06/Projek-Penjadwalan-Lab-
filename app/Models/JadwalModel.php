<?php

namespace App\Models;

use App\Controllers\Ta;
use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'mk',
        'nama_dosen',
        'hari',
        'tgl',
        'jenis',
        'kelas',
        'id_thn',
        'id_ruangan',
        'id_prodi'
    ];


    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;

    public function search($keyword)
    {
        $this->where('hari', $keyword);
        $this->orWhere('kelas', $keyword);
        $this->orWhere('mk', $keyword);
        $this->orWhere('jenis', $keyword);
        return $this->findAll();
    }



    public function joinRuangan()
    {
        $pegawai = new RuanganModel();
        return $this->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left');
    }
    public function joinTA()
    {
        $pegawai = new th_ajarModel();
        return $this->join('thn_ajaran', 'thn_ajaran.id_thn = jadwal.id_thn', 'left')
            ->where('thn_ajaran.status', 'AKTIF');
    }


    public function joinProdi()
    {
        $pegawai = new prodiModel();
        return $this->join('program_studi', 'program_studi.id_prodi = jadwal.id_prodi', 'left');
    }
    public function joinProdi1($idProdi)
    {
        $pegawai = new prodiModel();
        return $this->join('program_studi', 'program_studi.id_prodi = jadwal.id_prodi', 'left')
            ->where('user.id_prodi', $idProdi);
    }

    public function joinJam()
    {
        $jadwal = new JadwalDetailModel();
        $jam = new JamModel();
        return $this->join('jadwal_detail', 'jadwal_detail.id_jadwal = jadwal.id_jadwal')
            ->join('jam', 'jam.id = jadwal_detail.id_jam', 'left')
            ->orderBy('jadwal_detail.id_jadwal', 'DESC');
    }
    public function joinJam1()
    {
        $jadwal = new JadwalDetailModel();
        $jam = new JamModel();
        return $this->join('jadwal_detail', 'jadwal_detail.id_jadwal = jadwal.id_jadwal')
            ->join('jam', 'jam.id = jadwal_detail.id_jam', 'left');
    }


    public function joinDetail()
    {
        $jadwal = new JadwalDetailModel();
        return $this->join('jadwal_detail', 'jadwal_detail.id_jadwal = jadwal.id_jadwal');
    }

    public function getTahunAwal()
    {
        $thn_ajaran = new th_ajarModel();
        // Query untuk mendapatkan tahun awal dari jadwal yang statusnya aktif
        return $thn_ajaran->query("SELECT MAX(thn_awal) as thn_awal FROM thn_ajaran WHERE status = 'AKTIF'")->getRow()->thn_awal;
    }

    public function getTahunAkhir()
    {
        $thn_ajaran = new th_ajarModel();
        // Query untuk mendapatkan tahun akhir dari jadwal yang statusnya AKTIF
        return $thn_ajaran->query("SELECT MAX(thn_akhir) as thn_akhir FROM thn_ajaran WHERE status = 'AKTIF'")->getRow()->thn_akhir;
    }

    public function getSemester()
    {
        $thn_ajaran = new th_ajarModel();
        return $thn_ajaran->query("SELECT (semester) as semester FROM thn_ajaran WHERE status = 'AKTIF'")->getRow()->semester;
    }


    public function getHari($filter = null)
    {
        // Array hari-hari dari jadwal
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        // Jika parameter filter tidak kosong, filter array berdasarkan hari yang dipilih
        if ($filter !== null) {
            // Menggunakan fungsi array_filter untuk menyaring array berdasarkan nilai yang sesuai
            $hari = array_filter($hari, function ($item) use ($filter) {
                return $item == $filter;
            });
        }

        return $hari;
    }

    public function getJam()
    {
        $jamModel = new JamModel();
        // Query untuk mendapatkan jam-jam dari jadwal
        return $jamModel->table('jam')->get()->getResult();
    }

    public function getRuangan()
    {
        $ruangan = new RuanganModel();
        // Query untuk mendapatkan daftar ruangan dari jadwal
        return $ruangan->table('ruangan')->get()->getResult();
    }

    public function getJadwal()
    {
        return $this->db->table('jadwal')
            ->select('jadwal.*, jadwal_detail.id_jam, jam.id as jam_id') // tambahkan kolom id jam
            ->join('thn_ajaran', 'thn_ajaran.id_thn = jadwal.id_thn')
            ->join('jadwal_detail', 'jadwal_detail.id_jadwal = jadwal.id_jadwal')
            ->join('jam', 'jam.id = jadwal_detail.id_jam')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where('thn_ajaran.status', 'AKTIF')
            ->where('jadwal.jenis', 'REGULER')
            ->get()
            ->getResult();
    }
    public function getJadwalNonReguler()
    {
        return $this->db->table('jadwal')
            ->select('jadwal.*, jadwal_detail.id_jam, jam.id as jam_id') // tambahkan kolom id jam
            ->join('thn_ajaran', 'thn_ajaran.id_thn = jadwal.id_thn')
            ->join('jadwal_detail', 'jadwal_detail.id_jadwal = jadwal.id_jadwal')
            ->join('jam', 'jam.id = jadwal_detail.id_jam')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where('thn_ajaran.status', 'AKTIF')
            ->where('jadwal.jenis', 'NONREGULER')
            ->get()
            ->getResult();
    }
    public function getJadwalUAS()
    {
        return $this->db->table('jadwal')
            ->select('jadwal.*, jadwal_detail.id_jam, jam.id as jam_id') // tambahkan kolom id jam
            ->join('thn_ajaran', 'thn_ajaran.id_thn = jadwal.id_thn')
            ->join('jadwal_detail', 'jadwal_detail.id_jadwal = jadwal.id_jadwal')
            ->join('jam', 'jam.id = jadwal_detail.id_jam')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where('thn_ajaran.status', 'AKTIF')
            ->where('jadwal.jenis', 'UAS')
            ->get()
            ->getResult();
    }

    public function getJadwalUTS()
    {
        return $this->db->table('jadwal')
            ->select('jadwal.*, jadwal_detail.id_jam, jam.id as jam_id') // tambahkan kolom id jam
            ->join('thn_ajaran', 'thn_ajaran.id_thn = jadwal.id_thn')
            ->join('jadwal_detail', 'jadwal_detail.id_jadwal = jadwal.id_jadwal')
            ->join('jam', 'jam.id = jadwal_detail.id_jam')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where('thn_ajaran.status', 'AKTIF')
            ->where('jadwal.jenis', 'UTS')
            ->get()
            ->getResult();
    }



    public function data_thn()
    {
        // Lakukan query untuk mendapatkan tahun ajaran aktif
        $result = $this->db->table('thn_ajaran')
            ->select('id_thn')
            ->where('status', 'AKTIF')
            ->get()->getRow();

        // Ambil nilai tahun dari hasil query jika ada
        $tahun = $result ? $result->id_thn : '';

        return $tahun;
    }



    //save jadwal reguler
    public function simpan_jadwalreguler($mk, $kelas, $id_ruangan, $jam, $nama_dosen, $jenis, $id_thn, $hari, $id_prodi)
    {
        $jadwalreg = [
            'mk' => $mk,
            'nama_dosen' => $nama_dosen,
            'jenis' => $jenis,
            'kelas' => $kelas,
            'id_thn' => $id_thn,
            'id_ruangan' => $id_ruangan,
            'id_prodi' => $id_prodi,
            'hari' => $hari
        ];

        // Lakukan operasi penyimpanan jadwal reguler menggunakan data yang diterima dari controller
        $input = $this->db->table('jadwal')->insert($jadwalreg);

        if ($input) {
            $id_jadwal = $this->db->table('jadwal')
                ->select('id_jadwal')
                ->where('nama_dosen', $nama_dosen)
                ->where('jenis', $jenis)
                ->where('id_ruangan', $id_ruangan)
                ->where('id_prodi', $id_prodi)
                ->where('id_thn', $id_thn)
                ->where('hari', $hari)
                ->where('mk', $mk)
                ->where('kelas', $kelas)
                ->get()
                ->getResult();

            foreach ($id_jadwal as $jadwal) {
                $id_jadwalreg = $jadwal->id_jadwal;
                foreach ($jam as $j) {
                    $query = $this->db->query("INSERT INTO jadwal_detail VALUES (NULL, '$j', '$id_jadwalreg')");
                    $cek = "1";
                }
            }
            if ($cek == "1") {
                echo "<script>alert('Data Telah Disimpan')</script>";
                return redirect()->to('jadwal');
            } elseif ($cek == "0") {
                echo "<script>alert('Terjadi kesalahan dalam pengisian!')</script>";
                return redirect()->back();
            }
        }
    }

    public function simpan_jadwalnonreguler($mk, $kelas, $id_ruangan, $jam, $nama_dosen, $jenis, $id_thn, $hari, $id_prodi)
    {
        $jadwalreg = [
            'mk' => $mk,
            'nama_dosen' => $nama_dosen,
            'jenis' => $jenis,
            'kelas' => $kelas,
            'id_thn' => $id_thn,
            'id_ruangan' => $id_ruangan,
            'id_prodi' => $id_prodi,
            'hari' => $hari
        ];

        // Lakukan operasi penyimpanan jadwal reguler menggunakan data yang diterima dari controller
        $input = $this->db->table('jadwal')->insert($jadwalreg);

        if ($input) {
            $id_jadwal = $this->db->table('jadwal')
                ->select('id_jadwal')
                ->where('nama_dosen', $nama_dosen)
                ->where('jenis', $jenis)
                ->where('id_ruangan', $id_ruangan)
                ->where('id_prodi', $id_prodi)
                ->where('id_thn', $id_thn)
                ->where('hari', $hari)
                ->where('mk', $mk)
                ->where('kelas', $kelas)
                ->get()
                ->getResult();

            foreach ($id_jadwal as $jadwal) {
                $id_jadwalreg = $jadwal->id_jadwal;
                foreach ($jam as $j) {
                    $query = $this->db->query("INSERT INTO jadwal_detail VALUES (NULL, '$j', '$id_jadwalreg')");
                    $cek = "1";
                }
            }
            if ($cek == "1") {
                echo "<script>alert('Data Telah Disimpan')</script>";
                return redirect()->to('jadwal');
            } elseif ($cek == "0") {
                echo "<script>alert('Terjadi kesalahan dalam pengisian!')</script>";
                return redirect()->back();
            }
        }
    }


    public function simpan_jadwaluas($mk, $kelas, $id_ruangan, $jam, $nama_dosen, $jenis, $id_thn, $hari, $id_prodi)
    {
        $jadwalreg = [
            'mk' => $mk,
            'nama_dosen' => $nama_dosen,
            'jenis' => $jenis,
            'kelas' => $kelas,
            'id_thn' => $id_thn,
            'id_ruangan' => $id_ruangan,
            'id_prodi' => $id_prodi,
            'hari' => $hari
        ];

        // Lakukan operasi penyimpanan jadwal reguler menggunakan data yang diterima dari controller
        $input = $this->db->table('jadwal')->insert($jadwalreg);

        if ($input) {
            $id_jadwal = $this->db->table('jadwal')
                ->select('id_jadwal')
                ->where('nama_dosen', $nama_dosen)
                ->where('jenis', $jenis)
                ->where('id_ruangan', $id_ruangan)
                ->where('id_prodi', $id_prodi)
                ->where('id_thn', $id_thn)
                ->where('hari', $hari)
                ->where('mk', $mk)
                ->where('kelas', $kelas)
                ->get()
                ->getResult();


            foreach ($id_jadwal as $jadwal) {
                $id_jadwalreg = $jadwal->id_jadwal;
                foreach ($jam as $j) {
                    $query = $this->db->query("INSERT INTO jadwal_detail VALUES (NULL, '$j', '$id_jadwalreg')");
                    $cek = "1";
                }
            }
            if ($cek == "1") {
                echo "<script>alert('Data Telah Disimpan')</script>";
                return redirect()->to('jadwal');
            } elseif ($cek == "0") {
                echo "<script>alert('Terjadi kesalahan dalam pengisian!')</script>";
                return redirect()->back();
            }
        }
    }


    public function simpan_jadwaluts($mk, $kelas, $id_ruangan, $jam, $nama_dosen, $jenis, $id_thn, $hari, $id_prodi)
    {
        $jadwalreg = [
            'mk' => $mk,
            'nama_dosen' => $nama_dosen,
            'jenis' => $jenis,
            'kelas' => $kelas,
            'id_thn' => $id_thn,
            'id_ruangan' => $id_ruangan,
            'id_prodi' => $id_prodi,
            'hari' => $hari
        ];

        // Lakukan operasi penyimpanan jadwal reguler menggunakan data yang diterima dari controller
        $input = $this->db->table('jadwal')->insert($jadwalreg);

        if ($input) {
            $id_jadwal = $this->db->table('jadwal')
                ->select('id_jadwal')
                ->where('nama_dosen', $nama_dosen)
                ->where('jenis', $jenis)
                ->where('id_ruangan', $id_ruangan)
                ->where('id_prodi', $id_prodi)
                ->where('id_thn', $id_thn)
                ->where('hari', $hari)
                ->where('mk', $mk)
                ->where('kelas', $kelas)
                ->get()
                ->getResult();

            foreach ($id_jadwal as $jadwal) {
                $id_jadwalreg = $jadwal->id_jadwal;
                foreach ($jam as $j) {
                    $query = $this->db->query("INSERT INTO jadwal_detail VALUES (NULL, '$j', '$id_jadwalreg')");
                    $cek = "1";
                }
            }
            if ($cek == "1") {
                echo "<script>alert('Data Telah Disimpan')</script>";
                return redirect()->to('jadwal');
            } elseif ($cek == "0") {
                echo "<script>alert('Terjadi kesalahan dalam pengisian!')</script>";
                return redirect()->back();
            }
        }
    }


    public function getJadwalByJam($hari, $jam_id)
    {
        $jadwalModel = new JadwalModel();
        $jadwal = $jadwalModel->joinJam()->joinProdi()->joinRuangan()->joinTA()
            ->select('ruangan.nama_ruangan, program_studi.nama_prodi, jadwal.kelas')
            ->from('jadwal_detail') // Pilih kolom yang diinginkan
            ->where('thn_ajaran.status', 'AKTIF')
            ->where('jadwal.jenis', 'REGULER')
            ->where('jadwal.hari', $hari)
            ->where('jam.id', $jam_id)
            ->orderBy('ruangan.nama_ruangan', 'ASC')
            ->orderBy('jam.jam', 'ASC')
            ->get()
            ->getResult();

        return $jadwal;
    }


    // ->select('jadwal.*, jadwal_detail.id_jam, jam.id as jam_id')
}

