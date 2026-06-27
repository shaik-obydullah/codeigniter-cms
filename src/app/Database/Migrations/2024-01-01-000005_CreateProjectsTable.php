<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 4,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'serial' => [
                'type' => 'SMALLINT',
                'constraint' => 4,
                'null' => true,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'summary' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'null' => false,
                'default' => 'active',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addUniqueKey('serial');
        $this->forge->createTable('projects');
    }

    public function down()
    {
        $this->forge->dropTable('projects');
    }
}
