<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjectTagsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'fk_project_id' => [
                'type' => 'INT',
                'constraint' => 4,
                'null' => false,
            ],
            'fk_tag_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
        ]);
        $this->forge->addPrimaryKey(['fk_project_id', 'fk_tag_id']);
        $this->forge->addKey('fk_tag_id');
        $this->forge->createTable('project_tags');
    }

    public function down()
    {
        $this->forge->dropTable('project_tags');
    }
}
