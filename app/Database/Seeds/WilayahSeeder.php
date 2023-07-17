<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WilayahSeeder extends Seeder
{
    public function run()
    {
        $desa = [
            [
                'nama_wilayah' => 'Pusat',
                'user_id' => '1'
            ],
            [
                'nama_wilayah' => 'Desa A',
                'user_id' => '6'
            ],
            [
                'nama_wilayah' => 'Desa B',
                'user_id' => '7'
            ],
            [
                'nama_wilayah' => 'Desa C',
                'user_id' => '8'
            ]
        ];

        $this->db->table('wilayah')->insertBatch($desa);
    }
}
