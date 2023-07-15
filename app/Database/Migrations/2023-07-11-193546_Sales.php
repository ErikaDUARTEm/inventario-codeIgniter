<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sales extends Migration
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
            'customer_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'total' => [
                'Type' => 'INT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        // Agregar las claves foráneas
        $this->forge->addKey('id', true);
        $this->forge->addKey('customer_id', false);
        $this->forge->addKey('employee_id', false);

        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');

        
        $this->forge->createTable('sales');
        $this->db->enableForeignKeyChecks();
    }

        public function down()
    {    
        // Eliminar la tabla "sales"
        $this->forge->dropTable('sales');
    }
}
