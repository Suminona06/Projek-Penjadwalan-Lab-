<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalDetailModel extends Model
{
    protected $table = 'jadwal_detail';
    protected $primaryKey = 'id_jadwal_detail';

    protected $allowedFields = [
        'id_jam',
        'id_jadwal'
    ];

    protected bool $allowEmptyInserts = false;

}
