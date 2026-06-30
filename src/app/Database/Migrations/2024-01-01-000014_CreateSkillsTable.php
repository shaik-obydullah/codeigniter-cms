<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSkillsTable extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'name'        => ['type' => 'varchar', 'constraint' => 255],
            'icon'        => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'description' => ['type' => 'text', 'null' => true],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->createTable('skills');
    }

    public function down()
    {
        $this->forge->dropTable('skills');
    }
}
