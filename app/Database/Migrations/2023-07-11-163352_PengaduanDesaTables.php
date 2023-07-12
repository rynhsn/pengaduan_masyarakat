<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PengaduanDesaTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pengaduan_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
                'null'       => true,
            ],
            'desa_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
        ]);

        $this->forge->addForeignKey('pengaduan_id', 'pengaduan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('desa_id', 'desa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pengaduan_desa');
    }

    public function down()
    {
        $this->forge->dropTable('pengaduan_desa');
    }
}
