<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivitiesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fk_admin_id' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['success', 'warning', 'error'],
                'null' => false,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => false,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'visitor_country' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'visitor_state' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'visitor_city' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'visitor_address' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('activities');
    }

    public function down()
    {
        $this->forge->dropTable('activities');
    }
}
