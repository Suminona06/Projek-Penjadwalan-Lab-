<?php

namespace App\Models;

use CodeIgniter\Model;

class HardwareLab15 extends Model
{
    protected $table = 'h_lab7';
    protected $primaryKey = 'id_pc';
    protected $returnType = 'array';
    protected $allowedFields = [
        'nama_pc',
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
