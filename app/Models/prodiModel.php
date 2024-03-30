<?php

namespace App\Models;

use CodeIgniter\Model;

class prodiModel extends Model
{
    protected $table = 'program_studi';
    protected $primaryKey = 'id_prodi';
    protected $allowedFields = [
        'id_prodi',
        'kode_prodi',
        'nama_prodi',
        'id_jurusan',
        'program',
        
        

    ];

    public function joinJurusan()
    {
        $jurusan = new JurusanModel();
        return $this->join('jurusan', 'jurusan.id_jurusan = program_studi.id_jurusan', 'left');
    }
}


