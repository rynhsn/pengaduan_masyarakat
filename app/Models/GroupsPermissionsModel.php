<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupsPermissionsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auth_groups_permissions';
    protected $allowedFields    = ['group_id', 'permission_id', 'create', 'write', 'read'];

    public function updateAccess($groupId, $permissionId, $data)
    {
        $builder = $this->builder();
        $builder->where('group_id', $groupId);
        $builder->where('permission_id', $permissionId);
        $builder->update($data);
    }

}
