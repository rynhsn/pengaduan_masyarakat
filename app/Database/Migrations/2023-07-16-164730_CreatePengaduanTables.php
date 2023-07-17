<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengaduanTables extends Migration
{
    public function up()
    {$this->forge->addField([
        'kode' => [
            'type'           => 'varchar',
            'constraint'     => 100,
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
            'default'    => 1,
        ],
        'wilayah_id' => [
            'type'       => 'INT',
            'constraint' => 5,
            'unsigned'   => true,
            'default'    => 1,
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

        $this->forge->addPrimaryKey('kode');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('wilayah_id', 'wilayah', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_id', 'status_pengaduan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pengaduan');
    }

    public function down()
    {
        $this->forge->dropTable('pengaduan', true);
    }
}
