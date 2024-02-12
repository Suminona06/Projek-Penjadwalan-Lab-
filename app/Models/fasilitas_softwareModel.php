<?php

namespace App\Models;

use CodeIgniter\Model;

class fasilitas_softwareModel extends Model
{
    protected $table = 'f_software';
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
        return $this->join('ruangan', 'ruangan.id_ruangan = f_software.id_ruangan', 'left');
    }
}