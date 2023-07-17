<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use App\Models\StatusPengaduanModel;
use App\Models\WilayahModel;

class PengaduanMasuk extends BaseController
{
    protected PengaduanModel $pengaduanModel;
    protected StatusPengaduanModel $statusModel;
    protected WilayahModel $wilayahModel;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
        $this->statusModel = new StatusPengaduanModel();
        $this->wilayahModel = new WilayahModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaduan Masuk',
            'pengaduan' => $this->pengaduanModel->getAll('masuk'),
            'statusFilter' => $this->statusModel->getAll('masuk'),
            'status' => $this->statusModel->findAll(),
            'wilayah' => $this->wilayahModel->findAll(),
        ];
        return view('pengaduan-masuk/index', $data);
    }

    public function detail($kode)
    {
        $data = [
            'title' => 'Detail Pengaduan',
            'pengaduan' => $this->pengaduanModel->getById($kode),
            'status' => $this->statusModel->findAll(),
            'wilayah' => $this->wilayahModel->findAll(),
        ];
        return view('pengaduan-masuk/detail', $data);
    }

    //update wilayah
    public function update()
    {
        if(!$this->pengaduanModel->save($this->request->getVar())){
            session()->setFlashdata('error', 'Perubahan gagal dilakukan.');
            return redirect()->back();
        }
        session()->setFlashdata('message', 'Status pengaduan berhasil diubah.');
        return redirect()->back();
    }

    public function history(){
        $data = [
            'title' => 'Riwayat Pengaduan',
            'pengaduan' => $this->pengaduanModel->getAll('riwayat'),
            'statusFilter' => $this->statusModel->getAll('riwayat'),
            'status' => $this->statusModel->findAll(),
        ];
        return view('pengaduan-masuk/history', $data);
    }

    public function historyDetail($kode)
    {
        $data = [
            'title' => 'Detail Pengaduan',
            'pengaduan' => $this->pengaduanModel->getById($kode),
            'status' => $this->statusModel->findAll(),
        ];
        return view('pengaduan-masuk/history-detail', $data);
    }
}
