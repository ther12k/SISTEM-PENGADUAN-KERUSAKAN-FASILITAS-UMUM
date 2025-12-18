<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ResponseTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=> 'INT',
                'constraint'=> 11,
                'unsigned'=> true,
                'auto_increment'=> true
            ],
            'complaint_id'=>[
                'type'=> 'INT',
                'constraint'=> 11,
                'unsigned'=> true,
                'null'=> false
            ],
             'user_id'=>[
                'type'=> 'INT',
                'constraint'=> 11,
                'unsigned'=> true,
                'null'=> false
            ],
             'message'=>[
                'type'=> 'TEXT',
                'null'=> true
            ],
            'craeted_at'=>[
                'type'=> 'TEXT',
                'null'=> true
            ],
             'update_at'=>[
                'type'=> 'DATETIME',
                'null'=> true
            ],
        ]);
        //Key
        $this->forge->addKey('id',true);
        //Foreign Key
        $this->forge->addForeignKey('complaint_id','complaints','id','CASCASE','CASCADE');
        $this->forge->addForeignKey('user_id','users','id','CASCASE','CASCADE');
        // buat tabel
        $this->forge->createTable('responses',true);
    }

    public function down()
    {
        $this->forge->dropTable('responses', true);
    }
}
