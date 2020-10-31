<?php

use yii\db\Schema;
use yii\db\Migration;

class m151208_235734_create_table_transaction_details extends Migration
{
    public function up()
    {
        $this->createTable('{{%transaction_details}}', [
            'id' => $this->primaryKey(),
            'trans_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
            'quantity' => $this->decimal(15,2)->notNull()->defaultValue(0),
            'remarks' => $this->text(),
        ]);

        // foreign keys
        $this->addForeignKey(
            'fk_transaction_details_transactions', 
            '{{%transaction_details}}', 'trans_id', 
            '{{%transactions}}', 'id', 
            'restrict', 'cascade'
        );
        $this->addForeignKey(
            'fk_transaction_details_items', 
            '{{%transaction_details}}', 'item_id', 
            '{{%items}}', 'id', 
            'restrict', 'cascade'
        );
    }

    public function down()
    {
        $this->dropTable('{{%transaction_details}}');
    }
}
