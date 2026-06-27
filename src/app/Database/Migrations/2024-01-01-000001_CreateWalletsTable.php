<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWalletsTable extends Migration
{
    public function up()
    {
        $oldTables = ['admins', 'blogs', 'blogtag_relaton', 'tags', 'incomes', 'expenses', 'cashbook', 'configurations', 'messages', 'activities', 'files'];
        foreach ($oldTables as $table) {
            $this->forge->dropTable($table, true);
        }

        $this->forge->addField([
            'id' => [
                'type' => 'SMALLINT',
                'constraint' => 6,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
            'category' => [
                'type' => 'ENUM',
                'constraint' => ['income', 'expense'],
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('wallets');
    }

    public function down()
    {
        $this->forge->dropTable('wallets');
    }
}
