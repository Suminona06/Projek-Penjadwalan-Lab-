<?php

namespace App\Models;

use CodeIgniter\Model;

class fasilitas_hardwareModel extends Model
{
    protected $table = 'f_hardware';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'gambar',
        'keterangan',
        'id_ruangan',
    ];
}