<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pengaduan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Pengaduan Baru',
        ];
        return view('pengaduan/create', $data);
    }
}
