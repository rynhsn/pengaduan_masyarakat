<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroupsSeeder extends Seeder
{
    public function run()
    {

        $data = [
            ['name' => 'Super Admin', 'description' => 'Overpower Administrator'],
            ['name' => 'Administrator', 'description' => 'Administrator'],
            ['name' => 'User', 'description' => 'Penggguna']
        ];

        // Using Query Builder
        $this->db->table('auth_groups')->insertBatch($data);
    }
}
