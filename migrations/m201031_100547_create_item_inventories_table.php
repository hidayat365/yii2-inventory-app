<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_inventories}}`.
 */
class m201031_100547_create_item_inventories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_inventories}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'warehouse_id' => $this->integer()->notNull(),
            'quantity' => $this->decimal(15,2)->notNull()->defaultValue(0),
        ]);

        $this->addForeignKey(
            'fk_item_inventories_items', 
            '{{%item_inventories}}', 'item_id', 
            '{{%items}}', 'id', 
            'restrict', 'cascade'
        );
        $this->addForeignKey(
            'fk_item_inventories_warehouses', 
            '{{%item_inventories}}', 'warehouse_id', 
            '{{%warehouses}}', 'id', 
            'restrict', 'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_inventories}}');
    }
}
