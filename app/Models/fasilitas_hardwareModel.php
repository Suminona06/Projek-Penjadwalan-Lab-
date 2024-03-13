<?php

namespace App\Models;

use CodeIgniter\Model;

class fasilitas_hardwareModel extends Model
{
    protected $table = 'f_hardware_b';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'gambar',
        'nama',
        'jumlah',
        'id_ruangan',
    ];

    public function joinRuangan()
    {
        $ruangan = new RuanganModel();
        return $this->join('ruangan', 'ruangan.id_ruangan = f_hardware_b.id_ruangan', 'left');
    }
    public function orderByRuangan()
    {
        return $this->orderBy('f_hardware_b.id_ruangan', 'ASC');
    }
}