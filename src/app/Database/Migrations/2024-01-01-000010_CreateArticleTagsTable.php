<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticleTagsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'article_id' => ['type' => 'int', 'constraint' => 11],
            'tag_id'     => ['type' => 'int', 'constraint' => 11],
        ]);
        $this->forge->addPrimaryKey(['article_id', 'tag_id']);
        $this->forge->addForeignKey('article_id', 'articles', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('tag_id', 'tags', 'id', '', 'CASCADE');
        $this->forge->createTable('article_tags');
    }

    public function down()
    {
        $this->forge->dropTable('article_tags');
    }
}
