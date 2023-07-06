<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class MenusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'permission_id' => '4',
                'menu' => 'Menu Management',
                'description' => 'Pengaturan menu',
                'url' => null,
                'icon' => 'ki-outline ki-burger-menu-6',
                'is_active' => '1',
                'is_parent' => '1',
                'is_core' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '2',
                'created_at' => Time::now(),
            ],
            [
                'permission_id' => '1',
                'menu' => 'User Management',
                'description' => 'Pengaturan pengguna',
                'url' => null,
                'icon' => 'ki-outline ki-user',
                'is_active' => '1',
                'is_parent' => '1',
                'is_core' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '3',
                'created_at' => Time::now(),
            ]
        ];
        $this->db->table('menus');
        $this->db->table('menus')->insertBatch($data);
    }
}
