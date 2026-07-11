<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCommentsStatusToEnum extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE comments MODIFY COLUMN status ENUM('pending','approved','spam') NOT NULL DEFAULT 'pending'");
    }

    public function down()
    {
        $this->forge->modifyColumn('comments', [
            'status' => ['type' => 'varchar', 'constraint' => 20, 'default' => 'pending'],
        ]);
    }
}
