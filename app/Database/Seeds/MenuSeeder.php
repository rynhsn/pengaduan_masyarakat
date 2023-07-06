<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $this->call('MenusSeeder');
        $this->call('SubMenusSeeder');
    }
}
