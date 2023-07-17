<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use App\Models\StatusPengaduanModel;

class PengaduanRiwayat extends BaseController
{
    protected StatusPengaduanModel $statusModel;
    protected PengaduanModel $pengaduanModel;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
        $this->statusModel = new StatusPengaduanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Riwayat Pengaduan',
            'pengaduan' => $this->pengaduanModel->getAll('riwayat'),
            'statusFilter' => $this->statusModel->getAll('riwayat'),
            'status' => $this->statusModel->findAll(),
        ];
        return view('pengaduan-riwayat/index', $data);
    }
}
