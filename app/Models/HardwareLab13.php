<?php

namespace App\Models;

use CodeIgniter\Model;

class HardwareLab13 extends Model
{
    protected $table = 'h_lab5';
    protected $primaryKey = 'id_pc';
    protected $returnType = 'array';
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

    // Dates
    protected $useTimestamps = false;
}
