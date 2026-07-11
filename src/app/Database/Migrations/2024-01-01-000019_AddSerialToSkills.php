<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSerialToSkills extends Migration
{
    public function up()
    {
        $this->forge->addColumn('skills', [
            'serial' => ['type' => 'int', 'constraint' => 11, 'default' => 0, 'after' => 'id'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('skills', 'serial');
    }
}
