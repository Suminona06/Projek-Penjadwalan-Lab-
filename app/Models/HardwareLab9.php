<?php

namespace App\Models;

use CodeIgniter\Model;

class HardwareLab9 extends Model
{
    protected $table = 'f_hardware';
    protected $primaryKey = 'id_pc';
    protected $allowedFields = [
        'no_pc',
        'nama_pc',
        'windows',
        'processor',
        'ram',
        'mouse',
        'keyboard',
        'local_(c:)',
        'local_(d:)',

    ];

}
