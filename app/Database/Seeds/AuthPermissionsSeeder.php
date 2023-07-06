<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthPermissionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'            => 'manage-user',
                'description'     => 'Users Management',
            ],
            [
                'name'            => 'manage-permission',
                'description'     => 'Permission Management',
            ],
            [
                'name'          => 'manage-role',
                'description'   => 'Role Management',
            ],
            [
                'name'            => 'manage-menu',
                'description'     => 'Menu Management'
            ]
        ];

        // Using Query Builder
        $this->db->table('auth_permissions')->insertBatch($data);
    }
}
