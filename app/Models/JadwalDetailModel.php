<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalDetailModel extends Model
{
    protected $table = 'jadwal_detail';
    protected $primaryKey = 'id_jadwal_detail';

    protected $allowedFields = [
        'id_jam',
        'id_jadwal'
    ];

    protected bool $allowEmptyInserts = false;



    public function getJadwalByJam($hari_ini, $jam_id)
    {
        return $this->select('ruangan.nama_ruangan, program_studi.nama_prodi, jadwal.kelas, jadwal.nama_dosen')
            ->join('jam', 'jam.id = jadwal_detail.id_jam')
            ->join('jadwal', 'jadwal.id_jadwal = jadwal_detail.id_jadwal')
            ->join('program_studi', 'program_studi.id_prodi = jadwal.id_prodi')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->join('thn_ajaran', 'thn_ajaran.id_thn = jadwal.id_thn')
            ->where('thn_ajaran.status', 'AKTIF')
            ->where('jadwal.jenis', 'REGULER')
            ->where('jadwal.hari', $hari_ini)
            ->where('jam.id ', $jam_id)
            ->orderBy('ruangan.nama_ruangan', 'ASC')
            ->orderBy('jam.jam', 'ASC')
            ->get()
            ->getResultArray();
    }

}
