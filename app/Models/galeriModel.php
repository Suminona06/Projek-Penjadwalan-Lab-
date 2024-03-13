<?php

namespace App\Models;

use CodeIgniter\Model;

class galeriModel extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id_galeri';
    protected $allowedFields = [
        'id_galeri',
        'foto',
        'id_ruangan',

    ];

    public function joinRuangan()
    {
        $ruangan = new RuanganModel();
        return $this->join('ruangan', 'ruangan.id_ruangan = galeri.id_ruangan', 'left');
    }

    public function orderByRuangan()
    {
        return $this->orderBy('galeri.id_ruangan', 'ASC');
    }

    
}