<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivitiesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'     => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'type'        => ['type' => 'varchar', 'constraint' => '50'],
            'description' => ['type' => 'text'],
            'target_type' => ['type' => 'varchar', 'constraint' => '50', 'null' => true],
            'target_id'   => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('created_at');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'SET_NULL', 'CASCADE');
        $this->forge->createTable('activities');
    }

    public function down()
    {
        $this->forge->dropTable('activities');
    }
}
