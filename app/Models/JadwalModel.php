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
        return $this->join('jadwal_detail', 'jadwal_detail.id_jadwal = jadwal.id_jadwal', 'left')
            ->join('jam', 'jam.id = jadwal_detail.id_jam', 'left');
    }



}
