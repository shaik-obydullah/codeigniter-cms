<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'name'        => ['type' => 'varchar', 'constraint' => 255],
            'slug'        => ['type' => 'varchar', 'constraint' => 255],
            'description' => ['type' => 'text', 'null' => true],
            'icon'        => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
