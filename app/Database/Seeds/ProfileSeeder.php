<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'user_id' => 1,
            'nama_lengkap' => 'Super Admin',
            'nik' => '1234567890123456',
            'alamat' => 'Jl. Super Admin',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'telepon' => '081234567890',
            'foto_profil' => '300-29.jpg',
            'created_at' => '2021-07-05 13:38:47',
            'updated_at' => '2021-07-05 13:38:47',
        ];

        $this->db->table('profile')->insert($data);
    }
}
