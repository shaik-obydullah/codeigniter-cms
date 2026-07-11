<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'article_id'   => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'user_id'      => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'author_name'  => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'author_email' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'content'      => ['type' => 'text'],
            'status'       => ['type' => 'varchar', 'constraint' => 20, 'default' => 'pending'],
            'created_at'   => ['type' => 'datetime', 'null' => true],
            'updated_at'   => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addForeignKey('article_id', 'articles', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'SET_NULL');
        $this->forge->createTable('comments');
    }

    public function down()
    {
        $this->forge->dropTable('comments');
    }
}
