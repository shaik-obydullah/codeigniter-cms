<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterProjectsStatusToEnum extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE projects MODIFY COLUMN status ENUM('published','draft') NOT NULL DEFAULT 'draft'");
    }

    public function down()
    {
        $this->forge->modifyColumn('projects', [
            'status' => ['type' => 'varchar', 'constraint' => 20, 'default' => 'draft'],
        ]);
    }
}
