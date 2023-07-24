<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GroupsPermissionsModel;
use App\Models\PengaduanModel;
use Myth\Auth\Models\GroupModel;

class Dashboard extends BaseController
{
    protected GroupModel $groupModel;
    protected PengaduanModel $pengaduanModel;

    public function __construct()
    {
        $this->groupModel = new GroupModel();
        $this->pengaduanModel = new PengaduanModel();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Dashboard',
            'pengaduanMasuk' => $this->pengaduanModel->where('status_id', '1')->countAllResults(),
            'pengaduanDiproses' => $this->pengaduanModel->where('status_id >', '1')->where('status_id <', '8')->countAllResults(),
            'pengaduanSelesai' => $this->pengaduanModel->where('status_id', '8')->countAllResults(),
            'pengaduanDitolak' => $this->pengaduanModel->where('status_id', '9')->countAllResults(),
            'pengaduanPalsu' => $this->pengaduanModel->where('status_id', '10')->countAllResults(),
        ];
        return view('dashboard/index', $data);
    }
}
