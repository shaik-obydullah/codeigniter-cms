<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIncomesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fk_wallet_id' => [
                'type' => 'SMALLINT',
                'constraint' => 6,
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
            'currency' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
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
        $this->forge->createTable('incomes');
    }

    public function down()
    {
        $this->forge->dropTable('incomes');
    }
}
