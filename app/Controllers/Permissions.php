<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermissionModel;
use CodeIgniter\Database\BaseConnection;
use CodeIgniter\HTTP\ResponseInterface;
use ReflectionException;

class Permissions extends BaseController
{
    protected PermissionModel $permissionModel;
    protected BaseConnection $db;

    public function __construct()
    {
        $this->db = db_connect();
        $this->permissionModel = new PermissionModel();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Permissions',
            'permissions' => $this->permissionModel->getAll(),
        ];
        return view('permissions/index', $data);
    }

    public function store(): ResponseInterface
    {
        $data = $this->request->getJSON(true);
        $permission = $this->permissionModel->where('name', $data['name'])->first();
        if ($permission) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Nama permission sudah ada.',
            ]);
        }
        $this->db->table('auth_permissions')->insert($data);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Permission berhasil ditambahkan.',
            'data' => $data,
        ]);
    }

    /**
     * @throws ReflectionException
     */
    public function update(): ResponseInterface
    {
        $data = $this->request->getJSON();
        $this->db->table('auth_permissions')->update($data, ['id' => $data->id]);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Permission berhasil diupdate.',
            'data' => $data,
        ]);
    }

    public function destroy(): ResponseInterface
    {
        $id = $this->request->getVar('id');
        $this->permissionModel->delete($id);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Permission berhasil dihapus.',
        ]);
    }

//    get
    public function getPermission(): ResponseInterface
    {
        $id = $this->request->getVar('id');
        $permission = $this->permissionModel->where('id', $id)->first();
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Permission berhasil diambil.',
            'data' => $permission,
        ]);
    }
}
