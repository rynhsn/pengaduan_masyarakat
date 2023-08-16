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
            //setting status
//            [
//                'menu_id' => '8',
//                'permission_id' => '8',
//                'sub_menu' => 'Status Pengaduan',
//                'description' => 'Data Status',
//                'url' => 'status',
//                'icon' => 'ki-outline ki-gear',
//                'is_active' => '1',
//                'has_notify' => '0',
//                'notify' => '0',
//                'sequence' => '3',
//                'created_at' => Time::now(),
//            ],
//            //setting desa
//            [
//                'menu_id' => '8',
//                'permission_id' => '8',
//                'sub_menu' => 'Data Desa',
//                'description' => 'Data Desa',
//                'url' => 'desa',
//                'icon' => 'ki-outline ki-gear',
//                'is_active' => '1',
//                'has_notify' => '0',
//                'notify' => '0',
//                'sequence' => '1',
//                'created_at' => Time::now(),
//            ],
        ];

        $this->db->table('sub_menus');
        $this->db->table('sub_menus')->insertBatch($data);
    }
}
