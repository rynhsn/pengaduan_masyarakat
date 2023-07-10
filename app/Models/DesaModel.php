<?php

namespace App\Models;

use CodeIgniter\Model;

class DesaModel extends Model
{
    protected $table = 'desa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'user_id'];

    public function getByUserId($user_id)
    {
        return $this->where('user_id', $user_id)->findAll();
    }
}
