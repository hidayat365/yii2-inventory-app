<?php

use yii\db\Schema;
use yii\db\Migration;

class m151208_235652_create_table_transactions extends Migration
{
    public function up()
    {
        $this->createTable('{{%transactions}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'date' => $this->integer()->notNull()->defaultValue(0),
            'type_id' => $this->integer()->notNull(),
            'warehouse_id' => $this->integer()->notNull(),
            'remarks' => $this->text(),
        ]);

        // foreign keys
        $this->addForeignKey(
            'fk_transactions_types', 
            '{{%transactions}}', 'type_id', 
            '{{%transaction_types}}', 'id', 
            'restrict', 'cascade'
        );
        $this->addForeignKey(
            'fk_transactions_warehouses', 
            '{{%transactions}}', 'warehouse_id', 
            '{{%warehouses}}', 'id', 
            'restrict', 'cascade'
        );
    }

    public function down()
    {
        $this->dropTable('{{%transactions}}');
    }
}
