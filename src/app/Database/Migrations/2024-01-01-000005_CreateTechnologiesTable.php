<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTechnologiesTable extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'name'       => ['type' => 'varchar', 'constraint' => 255],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->createTable('technologies');
    }

    public function down()
    {
        $this->forge->dropTable('technologies');
    }
}
