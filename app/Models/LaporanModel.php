<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'laporan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['bulan', 'tahun', 'keterangan', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
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

    //getlaporan by id join detail_laporan, pengaduan, status_pengaduan
    public function getLaporan($id = null)
    {
        return $this->db->table('laporan')
            ->join('detail_laporan', 'detail_laporan.laporan_id = laporan.id')
            ->join('pengaduan', 'pengaduan.kode = detail_laporan.pengaduan_kode')
            ->join('status_pengaduan', 'status_pengaduan.id = detail_laporan.status_id')
            ->where('laporan.id', $id)
            ->get()->getRowArray();
    }

    public function cek(?string $bulan, ?string $tahun)
    {
        return $this->db->table('laporan')
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->get()->getRowArray();
    }

    //save laporan dan detail laporan
    public function saveLaporan($data)
    {
        $this->db->transStart();
        $this->db->table('laporan')->insert($data['laporan']);
        $laporan_id = $this->db->insertID();
        $this->db->table('detail_laporan')->insertBatch($data['detail_laporan']);
        $this->db->transComplete();
        return $this->db->transStatus();
    }
}
