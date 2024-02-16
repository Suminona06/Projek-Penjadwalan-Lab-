<?php

namespace App\Models;

use CodeIgniter\Model;

class unitModel extends Model
{
    protected $table = 'unit';
    protected $primaryKey = 'id_unit';
    protected $allowedFields = [
        'id_unit',
        'kode_unit',
        'nama_unit',
    ];
}
