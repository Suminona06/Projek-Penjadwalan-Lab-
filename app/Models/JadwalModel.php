<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id_jadwal';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
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


}
