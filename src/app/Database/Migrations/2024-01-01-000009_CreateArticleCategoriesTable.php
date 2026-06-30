<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticleCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'article_id'  => ['type' => 'int', 'constraint' => 11],
            'category_id' => ['type' => 'int', 'constraint' => 11],
        ]);
        $this->forge->addPrimaryKey(['article_id', 'category_id']);
        $this->forge->addForeignKey('article_id', 'articles', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', '', 'CASCADE');
        $this->forge->createTable('article_categories');
    }

    public function down()
    {
        $this->forge->dropTable('article_categories');
    }
}
