<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pengaduan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'status_id', 'judul', 'deskripsi', 'foto', 'tanggal', 'created_at', 'updated_at'];

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

    public function getByUserId($user_id)
    {
        //where user and join to user table
        return $this->join('users', 'users.id = pengaduan.user_id')
            ->join('profile', 'profile.user_id = pengaduan.user_id')
            ->join('status_pengaduan', 'status_pengaduan.id = pengaduan.status_id')
            ->where('pengaduan.user_id', $user_id)->findAll();
    }

    public function getByDesaId($desa_id)
    {
        return $this->where('desa_id', $desa_id)->findAll();
    }

    public function getByQuery($query)
    {

    }
}
