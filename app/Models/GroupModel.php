<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends \Myth\Auth\Models\GroupModel
{
    /**
     * @var mixed|null
     */
    protected $menuModel;

    public function getGroups(): array
    {
        $this->menuModel = new MenuModel();

        $groups = $this->findAll();
        foreach ($groups as $group) {
            $group->permissions = $this->getPermissionsForGroup($group->id);
            $group->users = $this->getUsersForGroup($group->id);
            $group->total_permission = count($group->permissions);
            $group->total_user = count($group->users);
        }
        return $groups;
    }

    //by id
    public function getGroup($id)
    {
        $this->menuModel = new MenuModel();

        $group = $this->find($id);
        $group->permissions = $this->getPermissionsForGroup($group->id);
        $group->users = $this->getUsersForGroup($group->id);
        $group->total_permission = count($group->permissions);
        $group->total_user = count($group->users);
        return $group;
    }


    /**
     * Updates user's permissons cache when group permissions altered.
     */
    public function handlePermissionsCache(int $groupId): void
    {
        $users = $this->getUsersForGroup($groupId);

        foreach ($users as $row) {
            cache()->delete("{$row['id']}_permissions");
        }
    }

}
