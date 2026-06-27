<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticleTagsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'fk_article_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'fk_tag_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
        ]);
        $this->forge->addPrimaryKey(['fk_article_id', 'fk_tag_id']);
        $this->forge->addKey('fk_tag_id');
        $this->forge->createTable('article_tags');
    }

    public function down()
    {
        $this->forge->dropTable('article_tags');
    }
}
