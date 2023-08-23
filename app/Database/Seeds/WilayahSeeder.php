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
                'nama_wilayah' => 'Desa Bandung',
                'user_id' => '6'
            ],
            [
                'nama_wilayah' => 'Desa Babakan',
                'user_id' => '7'
            ],
            [
                'nama_wilayah' => 'Desa Blokang',
                'user_id' => '8'
            ],
            [
                'nama_wilayah' => 'Desa Malabar',
                'user_id' => '9'
            ],
            [
                'nama_wilayah' => 'Desa Mander',
                'user_id' => '10'
            ],
            [
                'nama_wilayah' => 'Desa Pangawinan',
                'user_id' => '11'
            ],
            [
                'nama_wilayah' => 'Desa Panamping',
                'user_id' => '12'
            ],
            [
                'nama_wilayah' => 'Desa Pringwulung',
                'user_id' => '13'
            ]
        ];

        $this->db->table('wilayah')->insertBatch($desa);
    }
}
