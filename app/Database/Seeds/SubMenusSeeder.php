<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SubMenusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'menu_id' => '2',
                'permission_id' => '1',
                'sub_menu' => 'Users',
                'description' => 'Data Pengguna',
                'url' => 'users',
                'icon' => 'ki-outline ki-user',
                'is_active' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '1',
                'created_at' => Time::now(),
            ],
            [
                'menu_id' => '2',
                'permission_id' => '2',
                'sub_menu' => 'Permissions',
                'description' => 'Pengaturan Hak Akses',
                'url' => 'permissions',
                'icon' => 'ki-outline ki-lock',
                'is_active' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '3',
                'created_at' => Time::now(),
            ],
            [
                'menu_id' => '2',
                'permission_id' => '3',
                'sub_menu' => 'Roles',
                'description' => 'Data Role Pengguna',
                'url' => 'roles',
                'icon' => 'ki-outline ki-profile-user',
                'is_active' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '2',
                'created_at' => Time::now(),
            ],
            [
                'menu_id' => '1',
                'permission_id' => '4',
                'sub_menu' => 'Menus',
                'description' => 'Data Menu',
                'url' => 'menus',
                'icon' => 'ki-outline ki-menu',
                'is_active' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '1',
                'created_at' => Time::now(),
            ],
            [
                'menu_id' => '1',
                'permission_id' => '4',
                'sub_menu' => 'Sub Menus',
                'description' => 'Data Sub Menu',
                'url' => 'submenus',
                'icon' => 'ki-outline ki-menu',
                'is_active' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '2',
                'created_at' => Time::now(),
            ],
        ];

        $this->db->table('sub_menus');
        $this->db->table('sub_menus')->insertBatch($data);
    }
}
