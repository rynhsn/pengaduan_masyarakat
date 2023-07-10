<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPengaduanModel extends Model
{
    protected $table = 'status_pengaduan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['label', 'deskripsi', 'warna'];
}
