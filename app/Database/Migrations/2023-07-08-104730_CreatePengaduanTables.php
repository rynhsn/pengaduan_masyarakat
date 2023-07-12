<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengaduanTables extends Migration
{
    public function up()
    {$this->forge->addField([
        'id' => [
            'type'           => 'INT',
            'constraint'     => 5,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'user_id' => [
            'type'       => 'INT',
            'constraint' => 5,
            'unsigned'   => true,
            'null'       => true,
        ],
        'status_id' => [
            'type'       => 'INT',
            'constraint' => 5,
            'unsigned'   => true,
        ],
        'judul' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
        ],
        'deskripsi' => [
            'type' => 'TEXT',
        ],
        'komentar' => [
            'type' => 'TEXT',
            'null' => true,
        ],
        'foto' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
            'null' => true,
        ],
        'tanggal' => [
            'type' => 'DATE',
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_id', 'status_pengaduan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pengaduan');
    }

    public function down()
    {
        $this->forge->dropTable('pengaduan');
    }
}
