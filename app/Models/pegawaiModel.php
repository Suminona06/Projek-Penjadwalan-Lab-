<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields = true;
    protected $allowedFields = [
        'nama',
        'nip',
        'id_ruangan'
    ];

    protected bool $allowEmptyInserts = false;

}
