<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            'name' => 'adminn',
            'username' => 'admin1',
            'email' => 'admincontoh@gmail.com',
            'password'=>password_hash('admin12345', PASSWORD_BCRYPT),
        );

        $this->db->table('admin')->insert($data);
    }
}
