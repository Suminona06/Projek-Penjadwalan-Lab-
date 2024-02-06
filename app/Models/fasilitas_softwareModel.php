<?php

namespace App\Models;

use CodeIgniter\Model;

class fasilitas_softwareModel extends Model
{
    protected $table = 'f_software';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'gambar',
        'keterangan',
        'id_ruangan',
    ];
}