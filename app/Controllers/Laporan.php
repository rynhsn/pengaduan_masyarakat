<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporanModel;

class Laporan extends BaseController
{
    protected LaporanModel $laporanModel;

    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Laporan',
            'laporan' => $this->laporanModel->findAll(),
            'bulan' => [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ],
            'tahun' => [
                '2021', '2022', '2023', '2024', '2025'
            ]
        ];
        return view('laporan/index', $data);
    }

    //save
    public function store(){
        //cek bulan dan tahun
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');

        $cek = $this->laporanModel->cek($bulan, $tahun);

        if ($cek) {
            session()->setFlashdata('error', 'Laporan sudah ada!');
            return redirect()->back();
        }

        $this->laporanModel->save($this->request->getPost());
        session()->setFlashdata('message', 'Laporan berhasil ditambahkan!');
        return redirect()->back();
    }
}
