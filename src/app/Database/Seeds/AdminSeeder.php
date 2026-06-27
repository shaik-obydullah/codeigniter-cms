<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('admins')->insert([
            'first_name' => '',
            'last_name' => null,
            'user_name' => 'arnov',
            'sex' => null,
            'email' => 'admin@me.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'image' => null,
            'mobile' => null,
            'address' => null,
            'status' => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => 1,
        ]);

        echo 'Admin user created: arnov / admin' . PHP_EOL;
    }
}
