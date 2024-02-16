<?php

namespace App\Models;

use CodeIgniter\Model;

class th_ajarModel extends Model
{
    protected $table = 'thn_ajaran';
    protected $primaryKey = 'id_thn';
    protected $allowedFields = [
        'id_thn',
        'thn_awal',
        'thn_akhir',
        'semester',
        'status',
    ];
}

