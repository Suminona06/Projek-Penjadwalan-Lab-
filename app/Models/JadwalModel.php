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


    public function joinRuangan()
    {
        $pegawai = new RuanganModel();
        return $this->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left');
    }
    public function joinTA()
    {
        $pegawai = new th_ajarModel();
        return $this->join('thn_ajaran', 'thn_ajaran.id_thn = jadwal.id_thn', 'left');
    }
    public function joinProdi()
    {
        $pegawai = new prodiModel();
        return $this->join('program_studi', 'program_studi.id_prodi = jadwal.id_prodi', 'left');
    }

    public function joinJam()
    {
        $jadwal = new JadwalDetailModel();
        $jam = new JamModel();
        return $this->join('jadwal_detail', 'jadwal_detail.id_jadwal = jadwal.id_jadwal', )
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
        // Query untuk mendapatkan tahun awal dari jadwal
        return $thn_ajaran->query("SELECT MIN(thn_awal) as thn_awal FROM thn_ajaran")->getRow()->thn_awal;
    }

    public function getTahunAkhir()
    {
        $thn_ajaran = new th_ajarModel();
        // Query untuk mendapatkan tahun akhir dari jadwal
        return $thn_ajaran->query("SELECT MAX(thn_akhir) as thn_akhir FROM thn_ajaran")->getRow()->thn_akhir;
    }

    public function getHari()
    {
        // Query untuk mendapatkan hari-hari dari jadwal
        return ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
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


    public function data_thn()
    {
        $thn = $this->db->table('thn_ajaran')
            ->select('*')
            ->where('thn_ajaran.status', 'aktif')
            ->get()
            ->getResult();
        return $thn;
    }


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
            $cek = "0";
            $id_jadwal = $this->db->table('jadwal')
                ->select('id_jadwal')
                ->where('mk', $mk)
                ->where('nama_dosen', $nama_dosen)
                ->where('jenis', $jenis)
                ->where('id_ruangan', $id_ruangan)
                ->where('id_prodi', $id_prodi)
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





}

