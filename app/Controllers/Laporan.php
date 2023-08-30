<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailLaporanModel;
use App\Models\LaporanModel;
use App\Models\PengaduanModel;
use CodeIgniter\HTTP\RedirectResponse;

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
            'bulan' => $this->pengaduanModel->getBulan(),
            'tahun' => $this->pengaduanModel->getTahun(),
        ];

        return view('laporan/index', $data);
    }

    //detail
    public function detail($id): string
    {
        $data = [
            'title' => 'Detail Laporan',
            'laporan' => $this->laporanModel->find($id),
            'detail' => $this->detailLaporanModel->getDetailLaporan($id),
        ];

//        dd($data);
        return view('laporan/detail', $data);
    }

    //save
    public function store()
    {
        //cek bulan dan tahun
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');

        $cek = $this->laporanModel->cek($bulan, $tahun);

        if ($cek) {
            session()->setFlashdata('error', 'Laporan sudah ada!');
            return redirect()->back();
        }

        if (!$this->laporanModel->save($this->request->getPost())) {
            session()->setFlashdata('error', 'Laporan gagal ditambahkan!');
            return redirect()->back();
        }

        //get id laporan
        $laporan_id = $this->laporanModel->getInsertID();

        $pengaduan = $this->pengaduanModel->where('YEAR(created_at)', $tahun)->where('MONTH(created_at)', $bulan)->findAll();

        if ($pengaduan) {
            foreach ($pengaduan as $s) {
                $detail = [
                    'laporan_id' => $laporan_id,
                    'pengaduan_kode' => $s['kode'],
                    'status_id' => $s['status_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $this->detailLaporanModel->save($detail);
            }
        }


        session()->setFlashdata('message', 'Laporan berhasil ditambahkan!');
        return redirect()->back();
    }

    //drop
    public function drop($id): RedirectResponse
    {
        if (!$this->laporanModel->delete($id)) {
            session()->setFlashdata('error', 'Laporan gagal dihapus!');
            return redirect()->back();
        }

        session()->setFlashdata('message', 'Laporan berhasil dihapus!');
        return redirect()->back();
    }

}
