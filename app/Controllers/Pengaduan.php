<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use CodeIgniter\Encryption\EncrypterInterface;
use Config\Services;

class Pengaduan extends BaseController
{
    protected PengaduanModel $pengaduanModel;
    protected EncrypterInterface $encrypter;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
        $this->encrypter = Services::encrypter();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Sampaikan Pengaduan',
        ];
        return view('pengaduan/create', $data);
    }

    public function list(): string
    {
        $data = [
            'title' => 'Daftar Pengaduan',
            'pengaduan' => $this->pengaduanModel->getByUserId(user_id()),
            'encrypter' => $this->encrypter,
        ];

//        dd($data['pengaduan']);

        return view('pengaduan/index', $data);
    }

    public function edit($kode)
    {
        $data = [
            'title' => 'Edit Pengaduan',
            'validation' => Services::validation(),
            'pengaduan' => $this->pengaduanModel->find($kode),
        ];
        return view('pengaduan/edit', $data);
    }

    //save
    public function store()
    {
        $rules = [
            'foto' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Sepertinya ada yang salah, silahkan periksa kembali!');
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kode = 'TC-P' . time();

        $foto = $this->request->getFile('foto');
        $fileName = $kode;
        $path = 'media/uploads/pengaduan/';
        //cek gambar, apakah tetap gambar lama
        if ($foto->isValid()) {
            $namaFoto = $fileName . '.' . $foto->getExtension();
            $foto->move($path, $namaFoto);
        }

        $data = [
            'kode' => $kode,
            'user_id' => user_id(),
            'judul' => $this->request->getVar('judul'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'foto' => $namaFoto ?? null,
            'tanggal' => $this->request->getVar('tanggal') ?? date('Y-m-d'),
        ];

        if (!$this->pengaduanModel->insert($data)) {
            //remove uploaded files
            if (isset($namaFoto)) unlink($path . $namaFoto);
            session()->setFlashdata('error', 'Pengaduan gagal dikirim.');
            return redirect()->back();
        }

        session()->setFlashdata('message', 'Pengaduan berhasil dikirim.');
        return redirect()->to('/pengaduan/status');
    }

    public function update()
    {
        $rules = [
            'foto' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Sepertinya ada yang salah, silahkan periksa kembali!');
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto');
        $fileName = user()->id . '_' . time();
        $path = 'media/uploads/pengaduan/';
        //cek gambar, apakah tetap gambar lama
        if ($foto->isValid()) {
            $namaFoto = 'foto_' . $fileName . '.' . $foto->getExtension();
            unlink($path . $this->request->getVar('foto_lama'));
            $foto->move($path, $namaFoto);
        } else {
            $namaFoto = $this->request->getVar('foto_lama');
        }

        $kode = $this->request->getVar('kode');
        $data = [
            'user_id' => user_id(),
            'judul' => $this->request->getVar('judul'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'foto' => $namaFoto,
            'tanggal' => $this->request->getVar('tanggal') ?? date('Y-m-d'),
        ];

        if (!$this->pengaduanModel->update($kode, $data)) {
            //remove uploaded files
            if (isset($namaFoto)) unlink($path . $namaFoto);
            session()->setFlashdata('error', 'Pengaduan gagal ubah.');
            return redirect()->back();
        }

        session()->setFlashdata('message', 'Pengaduan berhasil ubah.');
        return redirect()->back();
    }

    public function destroy($kode){
        $pengaduan = $this->pengaduanModel->find($kode);
        if($pengaduan['foto'] != null){
            unlink('media/uploads/pengaduan/' . $pengaduan['foto']);
        }
        $this->pengaduanModel->delete($kode);
        session()->setFlashdata('message', 'Pengaduan berhasil dihapus.');
        return redirect()->back();
    }
}
