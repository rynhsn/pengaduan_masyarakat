<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroupPermissionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [ 'group_id' => '1', 'permission_id' => '1', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '1', 'permission_id' => '2', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '1', 'permission_id' => '3', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '1', 'permission_id' => '4', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '1', 'permission_id' => '5', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '1', 'permission_id' => '6', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '1', 'permission_id' => '7', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '1', 'permission_id' => '8', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '2', 'permission_id' => '1', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '2', 'permission_id' => '2', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '2', 'permission_id' => '3', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '2', 'permission_id' => '5', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '2', 'permission_id' => '7', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '2', 'permission_id' => '8', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '3', 'permission_id' => '6', 'read' => '1', 'write' => '1', 'create' => '1'],
            [ 'group_id' => '4', 'permission_id' => '7', 'read' => '1', 'write' => '0', 'create' => '0'],
            [ 'group_id' => '5', 'permission_id' => '5', 'read' => '1', 'write' => '1', 'create' => '0'],
            [ 'group_id' => '5', 'permission_id' => '7', 'read' => '1', 'write' => '0', 'create' => '0'],

        ];

        // Using Query Builder
        $this->db->table('auth_groups_permissions')->insertBatch($data);
    }
}
