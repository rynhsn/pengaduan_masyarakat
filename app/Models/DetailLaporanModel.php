<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailLaporanModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'detail_laporan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['laporan_id', 'pengaduan_kode', 'status_id', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    //get detail laporan by laporan_id
    public function getDetailLaporan($id)
    {
        $query = $this->db->table('detail_laporan')
            ->select('detail_laporan.*, pengaduan.created_at as tanggal_buat ,profile.nik, status_pengaduan.*')
            ->join('pengaduan', 'pengaduan.kode = detail_laporan.pengaduan_kode')
            ->join('profile', 'profile.user_id = pengaduan.user_id')
            ->join('status_pengaduan', 'status_pengaduan.id = detail_laporan.status_id')
            ->where('laporan_id', $id);
        if (in_groups('Kepala Desa')) {
            $wilayah = $this->db->table('wilayah')->select('*')->where('user_id', user_id())->get()->getRowArray();
            $query = $query->where('pengaduan.wilayah_id', $wilayah['id']);
//            return $wilayah;
        }
        $query = $query->get()->getResultArray();

        return $query;
    }

}
