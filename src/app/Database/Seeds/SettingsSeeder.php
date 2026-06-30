<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            ['class' => 'site', 'key' => 'site_name', 'value' => 'Shaik Obydullah', 'type' => 'string', 'context' => null],
            ['class' => 'site', 'key' => 'site_tagline', 'value' => 'Software Engineer | Laravel | Next.js | MySQL', 'type' => 'string', 'context' => null],
            ['class' => 'site', 'key' => 'site_email', 'value' => 'contact@obydullah.com', 'type' => 'string', 'context' => null],
            ['class' => 'site', 'key' => 'site_description', 'value' => 'Shaik Obydullah - Software Engineer specializing in Laravel, Next.js, and MySQL.', 'type' => 'string', 'context' => null],
            ['class' => 'social', 'key' => 'github', 'value' => '', 'type' => 'string', 'context' => null],
            ['class' => 'social', 'key' => 'linkedin', 'value' => '', 'type' => 'string', 'context' => null],
            ['class' => 'social', 'key' => 'twitter', 'value' => '', 'type' => 'string', 'context' => null],
            ['class' => 'social', 'key' => 'youtube', 'value' => '', 'type' => 'string', 'context' => null],
            ['class' => 'appearance', 'key' => 'theme_mode', 'value' => 'dark', 'type' => 'string', 'context' => null],
            ['class' => 'appearance', 'key' => 'items_per_page', 'value' => '15', 'type' => 'string', 'context' => null],
            ['class' => 'maintenance', 'key' => 'maintenance_mode', 'value' => '0', 'type' => 'boolean', 'context' => null],
            ['class' => 'maintenance', 'key' => 'allow_registration', 'value' => '1', 'type' => 'boolean', 'context' => null],
        ];

        $now = date('Y-m-d H:i:s');

        foreach ($settings as &$setting) {
            $setting['created_at'] = $now;
            $setting['updated_at'] = $now;
        }

        $this->db->table('settings')->insertBatch($settings);

        echo 'Default settings created.\n';
    }
}
