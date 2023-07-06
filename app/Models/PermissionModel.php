<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends \Myth\Auth\Models\PermissionModel
{
    public function getAll()
    {
        $permissions = $this->db->table('auth_permissions')
            ->select('auth_permissions.id, auth_permissions.name, auth_permissions.description, auth_groups.id as group_id, auth_groups.name as group_name')
            ->join('auth_groups_permissions', 'auth_groups_permissions.permission_id = auth_permissions.id', 'left')
            ->join('auth_groups', 'auth_groups.id = auth_groups_permissions.group_id', 'left')
            ->get()
            ->getResult();

        $permissionsArray = [];
        foreach ($permissions as $permission) {
            if (!isset($permissionsArray[$permission->id])) {
                $permissionsArray[$permission->id] = [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'description' => $permission->description,
                    'groups' => []
                ];
            }
            $permissionsArray[$permission->id]['groups'][] = [
                'group_id' => $permission->group_id,
                'group_name' => $permission->group_name
            ];
        }
        return $permissionsArray;
    }
}
