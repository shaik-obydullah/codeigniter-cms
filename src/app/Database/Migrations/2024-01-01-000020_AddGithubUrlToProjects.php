<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGithubUrlToProjects extends Migration
{
    public function up()
    {
        $this->forge->addColumn('projects', [
            'github_url' => ['type' => 'varchar', 'constraint' => 500, 'null' => true, 'after' => 'url'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('projects', 'github_url');
    }
}
