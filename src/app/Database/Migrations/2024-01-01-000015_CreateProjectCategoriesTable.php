<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjectCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'project_id'  => ['type' => 'int', 'constraint' => 11],
            'category_id' => ['type' => 'int', 'constraint' => 11],
        ]);
        $this->forge->addPrimaryKey(['project_id', 'category_id']);
        $this->forge->addForeignKey('project_id', 'projects', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', '', 'CASCADE');
        $this->forge->createTable('project_categories');
    }

    public function down()
    {
        $this->forge->dropTable('project_categories');
    }
}
