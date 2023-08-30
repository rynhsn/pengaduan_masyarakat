<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pengaduan';
    protected $primaryKey       = 'kode';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'status_id', 'wilayah_id', 'judul', 'deskripsi', 'komentar', 'foto', 'tanggal', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getAll($status =  null)
    {
        $query = $this->select('pengaduan.*, wilayah.nama_wilayah, users.username, users.email, profile.nama_lengkap, profile.foto_profil, status_pengaduan.label, status_pengaduan.deskripsi as status_deskripsi, status_pengaduan.warna')
            ->join('wilayah', 'wilayah.id = pengaduan.wilayah_id')
            ->join('users', 'users.id = pengaduan.user_id')
            ->join('profile', 'profile.user_id = pengaduan.user_id')
            ->join('status_pengaduan', 'status_pengaduan.id = pengaduan.status_id');

        if (in_groups('5')) {
            // Cari wilayah
            $wilayah = $this->db->table('wilayah')->select('wilayah.id')->where('wilayah.user_id', user()->id)->get()->getRowArray();
            $query = $query->where('pengaduan.wilayah_id', $wilayah['id']);
        }

        if ($status == 'masuk') {
            $query = $query->whereIn('pengaduan.status_id', ['1', '2', '3', '4', '5', '6', '7']);
        }
        elseif ($status == 'proses'){
            $query = $query->whereIn('pengaduan.status_id', ['2']);
        }
        elseif ($status == 'selesai'){
            $query = $query->whereIn('pengaduan.status_id', ['8']);
        }
        elseif ($status == 'tolak'){
            $query = $query->whereIn('pengaduan.status_id', ['9']);
        }
        elseif ($status == 'palsu'){
            $query = $query->whereIn('pengaduan.status_id', ['10']);
        }
        elseif ($status == 'riwayat') {
            $query = $query->whereIn('pengaduan.status_id', ['8', '9', '10']);
        }

        $results = $query->findAll();
        return $results;
    }

    public function getByUserId($user_id)
    {
        //where user and join to user table
        return $this->select('pengaduan.*, wilayah.nama_wilayah, users.email, profile.nama_lengkap, profile.foto_profil, status_pengaduan.label, status_pengaduan.deskripsi as status_deskripsi, status_pengaduan.warna')
            ->join('wilayah', 'wilayah.id = pengaduan.wilayah_id')
            ->join('users', 'users.id = pengaduan.user_id')
            ->join('profile', 'profile.user_id = pengaduan.user_id')
            ->join('status_pengaduan', 'status_pengaduan.id = pengaduan.status_id')
            ->where('pengaduan.user_id', $user_id)->findAll();
    }

    public function getByWilayahId($desa_id)
    {
        return $this->where('desa_id', $desa_id)->findAll();
    }

    public function getById($kode)
    {
        return $this->select('pengaduan.*, wilayah.nama_wilayah, users.username, users.email, profile.nama_lengkap, profile.foto_profil, status_pengaduan.label, status_pengaduan.deskripsi as status_deskripsi, status_pengaduan.warna')
            ->join('wilayah', 'wilayah.id = pengaduan.wilayah_id')
            ->join('users', 'users.id = pengaduan.user_id')
            ->join('profile', 'profile.user_id = pengaduan.user_id')
            ->join('status_pengaduan', 'status_pengaduan.id = pengaduan.status_id')
            ->where('pengaduan.kode', $kode)->first();
    }

    //get data tahun, group by tahun pengaduan berdasarkan created at
    public function getTahun()
    {
        //ambil kolom tahun nya saja
        $query = $this->select('YEAR(created_at) as tahun')->groupBy('tahun')->findAll();
        //ubah array menjadi array yang berisi tahun saja
        $tahun = [];
        foreach ($query as $key => $value) {
            $tahun[] = $value['tahun'];
        }
        return $tahun;
    }

    //get data bulan, group by bulan pengaduan berdasarkan created at
    public function getBulan()
    {
        //ambil kolom bulan nya saja
        $query = $this->select('MONTH(created_at) as bulan')->groupBy('bulan')->findAll();
        //ubah array menjadi array yang berisi bulan saja
        $bulan = [];
        foreach ($query as $key => $value) {
            $bulan[] = $value['bulan'];
        }
        return $bulan;
    }
}
