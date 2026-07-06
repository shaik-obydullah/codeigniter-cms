<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterArticlesStatusToEnum extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE articles MODIFY COLUMN status ENUM('published','draft') NOT NULL DEFAULT 'draft'");
    }

    public function down()
    {
        $this->forge->modifyColumn('articles', [
            'status' => ['type' => 'varchar', 'constraint' => 20, 'default' => 'draft'],
        ]);
    }
}
