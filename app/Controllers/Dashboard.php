<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GroupsPermissionsModel;
use Myth\Auth\Models\GroupModel;

class Dashboard extends BaseController
{
    protected GroupModel $groupModel;

    public function __construct()
    {
        $this->groupModel = new GroupModel();
    }

    public function index(): string
    {
//        $groupPermissionModel = new GroupsPermissionsModel();
//        $groups = $this->groupModel->getGroupsForUser(user_id());
//        foreach ($groups as $group) {
//            $groupPermission = $groupPermissionModel->where('group_id', $group['group_id'])->where('permission_id', 2)->first()['create'];
//        }
//        dd($groupPermission);
        $data = [
            'title' => 'Dashboard'
        ];
        return view('dashboard/index', $data);
    }
}
