<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sales extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // ...
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'quantity' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
            ],
            'price' => [
                'type' => 'INT',
            ],
            'customer_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'employee_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        // Agregar las claves foráneas
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');

        $this->forge->addKey('id', true);
        $this->forge->createTable('sales');
    }

        public function down()
    {
        $this->forge->dropForeignKey('sales', 'sales_product_id_foreign');
        $this->forge->dropForeignKey('sales', 'sales_customer_id_foreign');
        $this->forge->dropForeignKey('sales', 'sales_employee_id_foreign');
    
        // Eliminar la tabla "sales"
        $this->forge->dropTable('sales');
    }
}
