<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthPermissionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'manage-user', 'description' => 'Users Management'],
            ['name' => 'manage-permission','description' => 'Permission Management'],
            ['name' => 'manage-role','description' => 'Role Management'],
            ['name' => 'manage-menu','description' => 'Menu Management'],
            ['name' => 'manage-complaint','description' => 'Complaint Management'],
            ['name' => 'user-complaint', 'description' => 'User Complaint'],
            ['name' => 'laporan', 'description' => 'Laporan'],
            ['name' => 'settings', 'description' => 'Site Settings'],
        ];

        // Using Query Builder
        $this->db->table('auth_permissions')->insertBatch($data);
    }
}
