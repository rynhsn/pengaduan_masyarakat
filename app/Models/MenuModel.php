<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'menus';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['menu', 'permission_id', 'description', 'url', 'icon', 'is_active', 'is_parent', 'is_core', 'has_notify', 'notify', 'sequence'];

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

    //buat method delete
    /**
     * @var mixed|null
     */
    protected $menuAccess;

    /**
     * @var mixed|null
     */
    protected $subMenu;

    public function deleteMenu(int $id): bool
    {
        $this->subMenu = new SubMenuModel();
        $this->subMenu->deleteSubMenuByMenu($id);

        $this->delete($id);
        return true;
    }

    public function getAll(): array
    {
        $menus = $this->orderBy('sequence', 'ASC')->findAll();
        foreach ($menus as $key => $menu) {
            $menus[$key]['permission'] = $this->db->table('auth_permissions')->getWhere(['id' => $menu['permission_id']])->getRowArray()['description'];
        }
        return $menus;
    }
}
