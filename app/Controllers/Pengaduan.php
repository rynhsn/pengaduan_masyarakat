<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use Config\Services;

class Pengaduan extends BaseController
{
    protected PengaduanModel $pengaduanModel;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Sampaikan Pengaduan',
        ];
        return view('pengaduan/create', $data);
    }

    //save
    public function store()
    {
        $rules = [
            'foto1' => 'max_size[foto1,1024]|is_image[foto1]|mime_in[foto1,image/jpg,image/jpeg,image/png]',
            'foto2' => 'max_size[foto2,1024]|is_image[foto2]|mime_in[foto2,image/jpg,image/jpeg,image/png]',
            'foto3' => 'max_size[foto3,1024]|is_image[foto3]|mime_in[foto3,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Sepertinya ada yang salah, silahkan periksa kembali!');
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto1 = $this->request->getFile('foto1');
        $foto2 = $this->request->getFile('foto2');
        $foto3 = $this->request->getFile('foto3');

        $fileName = user()->id . '_' . time();
        $path = 'media/uploads/pengaduan/';
        //cek gambar, apakah tetap gambar lama
        if ($foto1->isValid()) {
            $namaFoto1 = 'foto1_' . $fileName . '.' . $foto1->getExtension();
            $foto1->move($path, $namaFoto1);
        }

        if ($foto2->isValid()) {
            $namaFoto2 = 'foto2_' . $fileName . '.' . $foto2->getExtension();
            $foto2->move($path, $namaFoto2);
        }

        if ($foto3->isValid()) {
            $namaFoto3 = 'foto3_' . $fileName . '.' . $foto3->getExtension();
            $foto3->move($path, $namaFoto3);
        }

        $data = [
            'user_id' => user_id(),
            'status_id' => 1, // 1 = 'Diterima'
            'judul' => $this->request->getVar('judul'),
            'keterangan' => $this->request->getVar('keterangan'),
            'foto1' => $namaFoto1 ?? null,
            'foto2' => $namaFoto2 ?? null,
            'foto3' => $namaFoto3 ?? null,
            'tanggal' => $this->request->getVar('tanggal') ?? date('Y-m-d'),
        ];

        if(!$this->pengaduanModel->save($data)){
            //remove uploaded files
            if (isset($namaFoto1)) unlink($path . $namaFoto1);
            if (isset($namaFoto2)) unlink($path . $namaFoto2);
            if (isset($namaFoto3)) unlink($path . $namaFoto3);
            session()->setFlashdata('error', 'Pengaduan gagal dikirim.');
            return redirect()->back();
        }

        session()->setFlashdata('message', 'Pengaduan berhasil dikirim.');
        return redirect()->back();
    }
}
