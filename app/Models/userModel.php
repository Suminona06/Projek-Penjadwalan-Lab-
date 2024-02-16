<?php

namespace App\Models;

use CodeIgniter\Model;

class userModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'id_user',
        'nama_user',
        'username',
        'password',
        'email',
        'status',
        'no_telp',
        'id_prodi',
    ];

    public function joinProdi()
    {
        $prodi = new ProdiModel();
        return $this->join('program_studi', 'program_studi.id_prodi = user.id_prodi', 'left');
    }

}

