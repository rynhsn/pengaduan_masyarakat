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
                'sequence' => '1',
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
                'sequence' => '2',
                'created_at' => Time::now(),
            ],
            //menu Manage Complaint
            [
                'permission_id' => '5',
                'menu' => 'Pengaduan Masuk',
                'description' => 'Pengaduan Masuk',
                'url' => 'pengaduan-masuk',
                'icon' => 'ki-outline ki-message-question',
                'is_active' => '1',
                'is_parent' => '0',
                'is_core' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '3',
                'created_at' => Time::now(),
            ],

            //riwayat pengaduan
            [
                'permission_id' => '5',
                'menu' => 'Riwayat Pengaduan',
                'description' => 'Riwayat pengaduan',
                'url' => 'pengaduan-masuk/riwayat',
                'icon' => 'ki-outline ki-time',
                'is_active' => '1',
                'is_parent' => '0',
                'is_core' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '4',
                'created_at' => Time::now(),
            ],

            //Pengaduan
            [
                'permission_id' => '6',
                'menu' => 'Pengaduan',
                'description' => 'Pengaduan',
                'url' => 'pengaduan',
                'icon' => 'ki-outline ki-message-question',
                'is_active' => '1',
                'is_parent' => '0',
                'is_core' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '5',
                'created_at' => Time::now(),
            ],

            //Status Pengaduan
            [
                'permission_id' => '6',
                'menu' => 'Status Pengaduan',
                'description' => 'Status Pengaduan',
                'url' => 'pengaduan/status',
                'icon' => 'ki-outline ki-like-tag',
                'is_active' => '1',
                'is_parent' => '0',
                'is_core' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '6',
                'created_at' => Time::now(),
            ],

            //lapooran
            [
                'permission_id' => '7',
                'menu' => 'Laporan',
                'description' => 'Laporan Pengaduan',
                'url' => 'laporan',
                'icon' => 'ki-outline ki-tablet-text-up',
                'is_active' => '1',
                'is_parent' => '0',
                'is_core' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '7',
                'created_at' => Time::now(),
            ],

            //settings
            [
                'permission_id' => '8',
                'menu' => 'Settings',
                'description' => 'Pengaturan',
                'url' => null,
                'icon' => 'ki-outline ki-gear',
                'is_active' => '1',
                'is_parent' => '1',
                'is_core' => '1',
                'has_notify' => '0',
                'notify' => '0',
                'sequence' => '8',
                'created_at' => Time::now(),
            ],
        ];
        $this->db->table('menus');
        $this->db->table('menus')->insertBatch($data);
    }
}
