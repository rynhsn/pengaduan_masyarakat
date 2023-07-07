<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenusTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'permission_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'menu'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'description'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'url'           => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'icon'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'is_active'     => ['type' => 'INT', 'constraint' => 1, 'default' => 1],
            'is_parent'     => ['type' => 'INT', 'constraint' => 1, 'default' => 0],
            'has_notify'    => ['type' => 'INT', 'constraint' => 1, 'default' => 0],
            'is_core'       => ['type' => 'INT', 'constraint' => 1, 'default' => 0],
            'notify'        => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'sequence'      => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('menu');
        $this->forge->addUniqueKey('url');
        $this->forge->addForeignKey('permission_id', 'auth_permissions', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('menus', true);

        //sub menus
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'menu_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'permission_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'sub_menu' => ['type' => 'VARCHAR', 'constraint' => 255],
            'description' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'icon' => ['type' => 'VARCHAR', 'constraint' => 255],
            'is_active' => ['type' => 'INT', 'constraint' => 1, 'default' => 1],
            'has_notify' => ['type' => 'INT', 'constraint' => 1, 'default' => 0],
            'notify' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'sequence' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['menu_id', 'sub_menu']);
        $this->forge->addUniqueKey(['menu_id', 'url']);
        $this->forge->addForeignKey('menu_id', 'menus', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('permission_id', 'auth_permissions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sub_menus', true);
    }

    public function down()
    {
        $this->forge->dropTable('menus', true);
        $this->forge->dropTable('sub_menus', true);
    }
}
