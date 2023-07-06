<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProfileTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id'    => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'nik'          => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'nama_lengkap'         => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat'       => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'tanggal_lahir'=> [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'jenis_kelamin'=> [
                'type'       => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
                'null'       => true,
            ],
            'telepon'      => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'foto_ktp'     => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'foto_profil'  => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'created_at'   => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at'   => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('profile');
    }

    public function down()
    {
        $this->forge->dropTable('profile');
    }
}
