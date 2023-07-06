<?php

namespace App\Models;

use CodeIgniter\Model;

class SubMenuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sub_menus';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['menu_id', 'permission_id', 'sub_menu', 'description', 'url', 'icon', 'is_active', 'has_notify', 'notify', 'sequence', 'created_at', 'updated_at', 'deleted_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function deleteSubMenuByMenu(int $menuId): bool
    {
        $this->where('menu_id', $menuId)->delete();
        return true;
    }

    public function getMenu($menuId): ?array
    {
        return $this->db->table('menus')->getWhere(['id' => $menuId])->getRowArray();
    }

    public function getPermission($permissionId): ?array
    {
        return $this->db->table('auth_permissions')->getWhere(['id' => $permissionId])->getRowArray();
    }

    public function getSubMenuByMenuId(int $menuId): array
    {
        return $this->where('menu_id', $menuId)->findAll();
    }
}
