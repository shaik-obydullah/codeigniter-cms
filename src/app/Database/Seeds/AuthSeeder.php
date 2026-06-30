<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use CodeIgniter\Shield\Entities\User;

class AuthSeeder extends Seeder
{
    public function run()
    {
        $users = model('UserModel');

        // Check if admin user already exists
        $existingUsers = $users->withIdentities()->findAll();
        foreach ($existingUsers as $u) {
            if ($u->email === 'admin@example.com') {
                // Update password on existing user
                $u->password = 'admin123';
                $u->active   = true;
                $users->save($u);

                echo 'Admin user updated: admin@example.com / admin123\n';
                return;
            }
        }

        $user = new User([
            'email'    => 'admin@example.com',
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        $users->save($user);

        $user = $users->find($users->getInsertID());
        $user->addGroup('superadmin');
        $user->active = true;
        $users->save($user);

        echo 'Admin user created: admin@example.com / admin123\n';
    }
}
