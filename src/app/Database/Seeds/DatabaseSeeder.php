<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('App\Database\Seeds\AuthSeeder');
        $this->call('App\Database\Seeds\SettingsSeeder');
    }
}
