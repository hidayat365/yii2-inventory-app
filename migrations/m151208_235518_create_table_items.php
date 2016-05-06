<?php

use yii\db\Schema;
use yii\db\Migration;

class m151208_235518_create_table_items extends Migration
{
    public function up()
    {
        $this->createTable('items', [
            'id' => Schema::TYPE_PK,
            'code' => Schema::TYPE_STRING . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'quantity' => Schema::TYPE_INTEGER . ' DEFAULT 0',
            'remarks' => Schema::TYPE_STRING,
        ]);
    }

    public function down()
    {
        $this->dropTable('items');
    }

}
