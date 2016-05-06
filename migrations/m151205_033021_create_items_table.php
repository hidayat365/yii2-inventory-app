<?php

use yii\db\Schema;
use yii\db\Migration;

class m151205_033021_create_items_table extends Migration
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


    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
