<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'user_id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'title'           => ['type' => 'varchar', 'constraint' => 255],
            'slug'            => ['type' => 'varchar', 'constraint' => 255],
            'content'         => ['type' => 'longtext', 'null' => true],
            'excerpt'         => ['type' => 'text', 'null' => true],
            'featured_image'  => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status'          => ['type' => 'varchar', 'constraint' => 20, 'default' => 'draft'],
            'published_at'    => ['type' => 'datetime', 'null' => true],
            'meta_title'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'meta_description' => ['type' => 'text', 'null' => true],
            'created_at'      => ['type' => 'datetime', 'null' => true],
            'updated_at'      => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addUniqueKey('slug');
        $this->forge->addKey('user_id');
        $this->forge->addKey('status');
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('articles');
    }

    public function down()
    {
        $this->forge->dropTable('articles');
    }
}
