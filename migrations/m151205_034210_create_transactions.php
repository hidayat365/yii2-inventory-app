<?php

use yii\db\Schema;
use yii\db\Migration;

class m151205_034210_create_transactions extends Migration
{
    public function up()
    {
        $this->createTable('transactions', [
            'id' => Schema::TYPE_PK,
            'trans_code' => Schema::TYPE_STRING . ' NOT NULL',
            'trans_date' => Schema::TYPE_DATE . ' NOT NULL DEFAULT 0',
            'type_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'remarks' => Schema::TYPE_STRING,
        ]);

        // foreign keys
        $this->addForeignKey(
            'fk_transactions_types', 
            'transactions', 'type_id', 
            'transaction_types', 'id', 
            'restrict', 'cascade');
    }

    public function down()
    {
        $this->dropTable('transactions');
    }
}
