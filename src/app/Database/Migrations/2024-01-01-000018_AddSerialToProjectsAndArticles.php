<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSerialToProjectsAndArticles extends Migration
{
    public function up()
    {
        $this->forge->addColumn('projects', [
            'serial' => ['type' => 'int', 'constraint' => 11, 'default' => 0, 'after' => 'id'],
        ]);

        $this->forge->addColumn('articles', [
            'serial' => ['type' => 'int', 'constraint' => 11, 'default' => 0, 'after' => 'id'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('projects', 'serial');
        $this->forge->dropColumn('articles', 'serial');
    }
}
