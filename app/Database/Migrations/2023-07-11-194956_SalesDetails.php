<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SalesDetails extends Migration
{
    public function up()

    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
        
            'id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'auto_increment'=> true
            ],
            'sale_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,

            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('sale_id', 'sales', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('SalesDetails');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
             // Eliminar la tabla "sales"
        $this->forge->dropTable('SalesDetails');
    }
}
