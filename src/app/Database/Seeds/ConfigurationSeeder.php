<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'project_name', 'setting' => 'Shaik Obydullah - Full Stack Developer | Backend & Frontend | DevOps & Cloud'],
            ['name' => 'meta_title', 'setting' => 'Shaik Obydullah - Full Stack Developer | Cloud & DevOps'],
            ['name' => 'meta_description', 'setting' => 'Full-Stack Developer (PHP/Laravel/React) | Systems Analyst. Transforming requirements into scalable, cloud-native solutions.'],
            ['name' => 'meta_keyword', 'setting' => 'Full-Stack Developer, PHP Developer, Laravel Developer, React Developer, Systems Analyst, Cloud Solutions, AWS, Database Architecture, MySQL, PostgreSQL, Next.js, Web Application Development, Software Engineer, Web Developer'],
            ['name' => 'meta_copyright', 'setting' => 'Shaik Obydullah. All Rights Reserved.'],
            ['name' => 'meta_url', 'setting' => 'https://obydullah.com/'],
            ['name' => 'meta_image', 'setting' => '/uploads/media-library/1746805140_cb36bdfafbcfa1cfb070.jpg'],
            ['name' => 'time_format', 'setting' => 'g:i A'],
            ['name' => 'date_format', 'setting' => 'F j, Y'],
            ['name' => 'time_zone', 'setting' => 'Europe/London'],
            ['name' => 'paginate_rows', 'setting' => '20'],
            ['name' => 'website_cache', 'setting' => '0'],
            ['name' => 'cache_duration', 'setting' => '1d'],
            ['name' => 'default_currency', 'setting' => 'GBP'],
            ['name' => 'currencies', 'setting' => '[{"code":"GBP","name":"British Pound","symbol":"£"},{"code":"USD","name":"US Dollar","symbol":"$"},{"code":"BDT","name":"Bangladeshi Taka","symbol":"৳"}]'],
            ['name' => 'linkedin', 'setting' => 'https://www.linkedin.com/in/shaik-obydullah/'],
            ['name' => 'github', 'setting' => 'https://github.com/shaik-obydullah/'],
        ];

        $this->db->table('configurations')->insertBatch($data);
    }
}
