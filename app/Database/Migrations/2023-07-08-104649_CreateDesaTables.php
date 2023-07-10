<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDesaTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
        'id' => [
            'type'           => 'INT',
            'constraint'     => 5,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'nama_desa' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
        ],
        'user_id' => [
            'type'       => 'INT',
            'constraint' => 5,
            'unsigned'   => true,
        ],
    ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('desa');
    }

    public function down()
    {
        $this->forge->dropTable('desa');
    }
}
