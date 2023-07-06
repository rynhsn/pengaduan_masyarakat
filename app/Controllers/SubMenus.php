<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\SubMenuModel;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\PermissionModel;
use ReflectionException;

class SubMenus extends BaseController
{
    protected SubMenuModel $subMenuModel;
    protected PermissionModel $permissionModel;
    protected MenuModel $menuModel;

    public function __construct()
    {
        $this->subMenuModel = new SubMenuModel();
        $this->permissionModel = new PermissionModel();
        $this->menuModel = new MenuModel();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Sub Menu Management',
            'menus' => $this->menuModel->where('is_parent', 1)->findAll(),
            'permissions' => $this->permissionModel->findAll(),
            'submenus' => $this->subMenuModel->findAll(),
        ];

        foreach ($data['submenus'] as $key => $submenu) {
            $data['submenus'][$key]['menu'] = $this->subMenuModel->getMenu($submenu['menu_id'])['menu'];
            $data['submenus'][$key]['permission'] = $this->subMenuModel->getPermission($submenu['permission_id'])['description'];
        }
        return view('submenus/index', $data);
    }

    /**
     * @throws ReflectionException
     */
    public function store(): ResponseInterface
    {
        //url harus unik
        $url = $this->subMenuModel->where('url', $this->request->getVar('url'))->first();
        if ($url) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'URL sudah ada.',
                'data' => $this->request->getVar('url')
            ]);
        }
        $data = $this->request->getVar();
        if (!$this->subMenuModel->save($data)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Sub Menu gagal disimpan.',
                'data' => $data
            ]);
        }
        // Kirim respon ke JavaScript
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Sub Menu berhasil disimpan.',
            'data' => $data
        ]);
    }

    /**
     * @throws ReflectionException
     */
    public function update(): ResponseInterface
    {
        $id = $this->request->getVar('id');
        $data = ['menu_id', 'permission_id', 'sub_menu', 'description', 'url', 'icon', 'is_active', 'has_notify', 'sequence'];
        if (!$this->subMenuModel->update($id, $this->request->getVar())) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Sub Menu gagal diupdate.',
                'data' => $this->request->getVar($data)
            ]);
        }
        // Kirim respon ke JavaScript
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Sub Menu berhasil diupdate.',
            'data' => $this->request->getVar($data)
        ]);
    }

    public function destroy(): ResponseInterface
    {
        if (!$this->subMenuModel->delete($this->request->getVar('id'))) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Sub Menu gagal dihapus.'
            ]);
        }
        // Kirim respon ke JavaScript
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Sub Menu berhasil dihapus.'
        ]);
    }


    public function getSubMenu(): ResponseInterface
    {
        $id = $this->request->getVar('id');
        $data = $this->subMenuModel->find($id);
        $data['menu'] = $this->subMenuModel->getMenu($data['menu_id'])['menu'];
        $data['permission'] = $this->subMenuModel->getPermission($data['permission_id'])['description'];
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Sub Menu berhasil ditemukan.',
            'data' => $data
        ]);
    }

    public function getSubMenuByMenuId(): ResponseInterface
    {
        $id = $this->request->getVar('id');
        $data = $this->subMenuModel->getSubMenuByMenuId($id);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Sub Menu berhasil ditemukan.',
            'data' => $data
        ]);
    }
}
