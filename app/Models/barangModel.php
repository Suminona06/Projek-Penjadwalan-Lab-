<?php

namespace App\Models;

use CodeIgniter\Model;

class barangModel extends Model
{
    protected $table = 'aset';
    protected $primaryKey = 'id_aset';
    protected $allowedFields = [
        'deskripsi',
        'serialnumber',
        'supplier',
        'brand',
        'model',
        'penanggungjawab',
    ];
}