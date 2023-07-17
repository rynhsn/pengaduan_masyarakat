<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPengaduanModel extends Model
{
    protected $table = 'status_pengaduan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['label', 'deskripsi', 'warna'];

    public function getAll($status = null)
    {
        $query = $this->select('*');

        if ($status == 'masuk') {
            $query = $query->whereIn('id', ['1', '2', '3', '4', '5', '6', '7']);
        } elseif ($status == 'riwayat') {
            $query = $query->whereIn('id', ['8', '9', '10']);
        }

        return $query->findAll();
    }

}
