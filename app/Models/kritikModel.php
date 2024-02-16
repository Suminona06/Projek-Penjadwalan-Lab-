<?php

namespace App\Models;

use CodeIgniter\Model;

class kritikModel extends Model
{
    protected $table = 'kontak';
    protected $primaryKey = 'id_kontak';
    protected $allowedFields = [
        'id_kontak',
        'tanggal',
        'nama',
        'email',
        'komentar'
    ];
}