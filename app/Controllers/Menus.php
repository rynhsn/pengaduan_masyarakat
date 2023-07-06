<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\PermissionModel;
use ReflectionException;

class Menus extends BaseController
{
    protected MenuModel $menuModel;
    protected PermissionModel $permissionModel;

    public function __construct()
    {
        $this->permissionModel = new PermissionModel();
        $this->menuModel = new MenuModel();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Menu Management',
            'menus' => $this->menuModel->getAll(),
            'permissions' => $this->permissionModel->findAll()
        ];
        return view('menus/index', $data);
    }

    public function getMenu(): ResponseInterface
    {
        $menu = $this->menuModel->find($this->request->getVar('menu_id'));

        if(!$menu){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Menu tidak ditemukan.',
                'data' => $this->request->getVar('menu_id')
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Menu berhasil diambil.',
            'data' => $menu
        ]);
    }

    /**
     * @throws ReflectionException
     */
    public function store(): ResponseInterface
    {
        $data = [
            'permission_id' => $this->request->getVar('permission_id'),
            'menu' => $this->request->getVar('menu'),
            'description' => $this->request->getVar('desc'),
            'url' => $this->request->getVar('url') ?: null,
            'icon' => $this->request->getVar('icon'),
            'sequence' => $this->request->getVar('sequence'),
            'is_active' => $this->request->getVar('is_active'),
            'is_parent' => $this->request->getVar('is_parent'),
            'is_core' => $this->request->getVar('is_core'),
            'has_notify' => $this->request->getVar('has_notify'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if (!$this->menuModel->save($data)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Menu gagal disimpan.',
                'data' => $data
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Menu berhasil disimpan.',
            'data' => $data
        ]);
    }

    public function destroy(): ResponseInterface
    {
        $id = $this->request->getVar('menu_id');
        if (!$this->menuModel->deleteMenu($id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Menu gagal dihapus.',
                'data' => $id
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Menu berhasil dihapus.',
            'data' => $id
        ]);
    }

    /**
     * @throws ReflectionException
     */
    public function update(): ResponseInterface
    {
        $id = $this->request->getVar('id');
        $data = [
            'permission_id' => $this->request->getVar('permission_id'),
            'menu' => $this->request->getVar('menu'),
            'description' => $this->request->getVar('description'),
            'url' => $this->request->getVar('url') ?: null,
            'icon' => $this->request->getVar('icon'),
            'sequence' => $this->request->getVar('sequence'),
            'is_active' => $this->request->getVar('is_active'),
            'is_parent' => $this->request->getVar('is_parent'),
            'is_core' => $this->request->getVar('is_core'),
            'has_notify' => $this->request->getVar('has_notify'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if (!$this->menuModel->update($id, $data)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Menu gagal diupdate.',
                'data' => $data
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Menu berhasil diupdate.',
            'id' => $id,
            'data' => $data
        ]);
    }
}
