<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailLaporanModel;
use App\Models\LaporanModel;
use App\Models\PengaduanModel;

class Laporan extends BaseController
{
    protected LaporanModel $laporanModel;
    protected PengaduanModel $pengaduanModel;
    protected DetailLaporanModel $detailLaporanModel;

    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
        $this->pengaduanModel = new PengaduanModel();
        $this->detailLaporanModel = new DetailLaporanModel();
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

        if(!$this->laporanModel->save($this->request->getPost())){
            session()->setFlashdata('error', 'Laporan gagal ditambahkan!');
            return redirect()->back();
        }

        //get id laporan
        $laporan_id = $this->laporanModel->getInsertID();

        $pengaduan = $this->pengaduanModel->where('YEAR(created_at)', $tahun)->where('MONTH(created_at)', $bulan)->findAll();

        foreach ($pengaduan as $s) {
            $detail = [
                'laporan_id' => $laporan_id,
                'pengaduan_kode' => $s['kode'],
                'status_id' => $s['status_id'],
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->detailLaporanModel->save($detail);
        }


        session()->setFlashdata('message', 'Laporan berhasil ditambahkan!');
        return redirect()->back();
    }
}
