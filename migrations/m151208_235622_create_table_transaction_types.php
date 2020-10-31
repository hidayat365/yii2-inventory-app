<?php

use yii\db\Schema;
use yii\db\Migration;

class m151208_235622_create_table_transaction_types extends Migration
{
    public function up()
    {
        $this->createTable('{{%transaction_types}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(100)->notNull(),
        ]);
        
        // default data
        $this->insert('{{%transaction_types}}', [
            'id' => 1,
            'code' => 'IN',
            'name' => 'Barang Masuk',
        ]);
        $this->insert('{{%transaction_types}}', [
            'id' => 2,
            'code' => 'OUT',
            'name' => 'Barang Keluar',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%transaction_types}}');
    }
}
