<?php

namespace App\Controllers;

use App\Models\GroupModel;
use App\Models\GroupsPermissionsModel;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\PermissionModel;
use ReflectionException;

class Roles extends BaseController
{
    protected GroupModel $roleModel;
    protected GroupsPermissionsModel $groupPermissionModel;
    protected PermissionModel $permissionModel;

    public function __construct()
    {
        $this->roleModel = new GroupModel();
        $this->permissionModel = new PermissionModel();
        $this->groupPermissionModel = new GroupsPermissionsModel();
        $this->db = db_connect();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Roles',
            'roles' => $this->roleModel->getGroups(),
            'permissions' => $this->permissionModel->findAll(),
        ];
        return view('roles/index', $data);
    }

    /**
     * @throws ReflectionException
     */
    public function store(): ResponseInterface
    {
        //cek apakah ada group dengan nama yang sama
        $data = $this->request->getJSON(true);
        $group = $this->roleModel->where('name', $data['group']['name'])->first();
        if ($group) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Nama group sudah ada.',
            ]);
        }
        $this->db->transStart();
        $this->db->table('auth_groups')->insert($data['group']);
        $group_id = $this->db->insertID();
        $permissions = $data['permissions'];
        foreach ($permissions as &$permission) {
            $permission['group_id'] = $group_id;
        }
        $this->db->table('auth_groups_permissions')->insertBatch($permissions);
        $this->roleModel->handlePermissionsCache($group_id);
        $this->db->transComplete();
        if ($this->db->transStatus() === FALSE) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data gagal disimpan.',
                'data' => $permissions,
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil disimpan.',
            'data' => $permissions,
        ]);
    }

    public function getRole($id)
    {
        $role = $this->roleModel->find($id);
        $permissions = $this->groupPermissionModel->where('group_id', $id)->findAll();
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil ditemukan.',
            'data' => [
                'role' => $role,
                'permissions' => $permissions,
            ],
        ]);
    }

    /**
     * @throws ReflectionException
     */
    public function update(): ResponseInterface
    {
        $data = $this->request->getJSON(true);
        $group_id = $data['group']['id'];
        $permissions = $data['permissions'];
        $this->db->transStart();
        $this->db->table('auth_groups')->update($data['group'], ['id' => $group_id]);
        $this->groupPermissionModel->where('group_id', $group_id)->delete();
        $this->groupPermissionModel->insertBatch($permissions);
        $this->roleModel->handlePermissionsCache($group_id);
        $this->db->transComplete();
        if ($this->db->transStatus() === FALSE) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data gagal disimpan.',
            ]);
        }
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil disimpan.',
            'data' => $permissions,
        ]);
    }

    public function detail($id){
        $data = [
            'title' => 'Roles',
            'role' => $this->roleModel->getGroup($id),
        ];

        return view('roles/view', $data);
    }
}
