<?php

use App\Models\GroupModel;
use App\Models\GroupsPermissionsModel;
use App\Models\MenuModel;
use App\Models\ProfileModel;
use App\Models\SubMenuModel;

function getMenus(): array
{
    $menuModel = new MenuModel();
    return $menuModel->orderBy('sequence', 'ASC')->findAll();
}
function getSubMenus(int $id): array
{
    $subMenuModel = new SubMenuModel();
    return $subMenuModel->where('menu_id', $id)->orderBy('sequence', 'ASC')->findAll();
}
if (!function_exists('isActiveLink')) {
    /**
     * Mengecek apakah link sedang aktif berdasarkan URI.
     *
     * @param string $uri
     * @return bool
     */
    function isActiveLink(string $uri = null, int $menuId = null): bool
    {
        $currentURI = service('uri')->getPath();

        if ($currentURI == $uri) {
            return true;
        }

        if ($uri == null && $menuId != null) {
            foreach (getSubMenus($menuId) as $submenu) {
                if ($submenu['url'] == $currentURI) {
                    return true;
                }
            }
        }
        return false;
    }
}
//has action access
function hasActionAccess(string $action, int $userId, int $menuId = null): bool
{
    $subMenuModel = new SubMenuModel();
    $menuModel = new MenuModel();
    $groupModel = new GroupModel();
    $groupPermissionModel = new GroupsPermissionsModel();
    $currentURI = service('uri')->getSegment(1);
    if ($menuId != null) {
        $permission_temp = $menuModel->where('id', $menuId)->first();
        if ($permission_temp == null) {
            $permission_temp = $subMenuModel->where('id', $menuId)->first();
        }
    } else {
        $permission_temp = $menuModel->where('url', $currentURI)->first();
        if ($permission_temp == null) {
            $permission_temp = $subMenuModel->where('url', $currentURI)->first();
        }
    }
    $permission = has_permission($permission_temp['permission_id']);
    if ($permission) {
        //cari di tabel auth_groups_permissions
        $groups = $groupModel->getGroupsForUser($userId);
        foreach ($groups as $group) {
            $hasPermission = $groupPermissionModel->where('group_id', $group['group_id'])->where('permission_id', $permission_temp['permission_id'])->first();
            if ($hasPermission) {
                if ($hasPermission[$action]) {
                    return true;
                }
            }
        }
    }
    return false;
}
//ambil foto profile dari tabel profile berdasarkan user_id
function getProfilePicture(int $userId): string
{
    $userModel = new ProfileModel();
    $user = $userModel->where('user_id', $userId)->first();
    return $user['foto_profil'];
}
