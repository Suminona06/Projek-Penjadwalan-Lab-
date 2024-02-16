<?php

namespace App\Models;

use CodeIgniter\Model;

class jurusanModel extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $allowedFields = [
        'id_jurusan',
        'nama_jurusan',
    ];
}