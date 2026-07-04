<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjectTagsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'project_id' => ['type' => 'int', 'constraint' => 11],
            'tag_id'     => ['type' => 'int', 'constraint' => 11],
        ]);
        $this->forge->addPrimaryKey(['project_id', 'tag_id']);
        $this->forge->addForeignKey('project_id', 'projects', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('tag_id', 'tags', 'id', '', 'CASCADE');
        $this->forge->createTable('project_tags');
    }

    public function down()
    {
        $this->forge->dropTable('project_tags');
    }
}
