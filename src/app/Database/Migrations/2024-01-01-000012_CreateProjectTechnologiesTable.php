<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjectTechnologiesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'project_id'    => ['type' => 'int', 'constraint' => 11],
            'technology_id' => ['type' => 'int', 'constraint' => 11],
        ]);
        $this->forge->addPrimaryKey(['project_id', 'technology_id']);
        $this->forge->addForeignKey('project_id', 'projects', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('technology_id', 'technologies', 'id', '', 'CASCADE');
        $this->forge->createTable('project_technologies');
    }

    public function down()
    {
        $this->forge->dropTable('project_technologies');
    }
}
