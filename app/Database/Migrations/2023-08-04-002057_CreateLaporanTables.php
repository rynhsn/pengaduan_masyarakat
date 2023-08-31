<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLaporanTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
//            'bulan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
//            'tahun' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tanggal_awal' => ['type' => 'DATE', 'null' => true],
            'tanggal_akhir' => ['type' => 'DATE', 'null' => true],
            'keterangan' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('laporan');

        //detail laporan

        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'laporan_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'pengaduan_kode' => ['type' => 'varchar', 'constraint' => 100],
            'status_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('laporan_id', 'laporan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pengaduan_kode', 'pengaduan', 'kode', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_id', 'status_pengaduan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_laporan');

    }

    public function down()
    {
        $this->forge->dropTable('laporan', true);
        $this->forge->dropTable('detail_laporan', true);
    }
}
