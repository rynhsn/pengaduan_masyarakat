<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DesaSeeder extends Seeder
{
    public function run()
    {
        $desa = [
            [
                'nama_desa' => 'Desa A',
                'user_id' => '6'
            ],
            [
                'nama_desa' => 'Desa B',
                'user_id' => '7'
            ],
            [
                'nama_desa' => 'Desa C',
                'user_id' => '8'
            ]
        ];

        $this->db->table('desa')->insertBatch($desa);
    }
}
