<?php

namespace App\Models;

use CodeIgniter\Model;

class barangModel extends Model
{
    protected $table = 'aset';
    protected $primaryKey = 'id_aset';
    protected $allowedFields = [
        'deskripsi',
        'serialnumber',
        'supplier',
        'brand',
        'model',
        'penanggungjawab',
        'id_ruangan',
    ];

    public function aset()
    {
        return $this->orderBy('aset.id_aset', 'DESC');
    }


    public function joinRuangan()
    {
        $ruangan = new RuanganModel();
        return $this->join('ruangan', 'ruangan.id_ruangan = aset.id_ruangan', 'left');
    }

    public function orderByRuangan()
    {
         return $this->orderBy('aset.id_ruangan', 'ASC');
     }
}