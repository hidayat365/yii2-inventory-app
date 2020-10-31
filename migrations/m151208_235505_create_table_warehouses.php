<?php

use yii\db\Schema;
use yii\db\Migration;

class m151208_235505_create_table_warehouses extends Migration
{
    public function up()
    {
        $this->createTable('{{%warehouses}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(100)->notNull(),
            'location_id' => $this->integer()->notNull(),
        ]);

        // foreign keys
        $this->addForeignKey(
            'fk_warehouses_locations', 
            '{{%warehouses}}', 'location_id', 
            '{{%locations}}', 'id', 
            'restrict', 'cascade'
        );

        // default data
        $this->insert('{{%warehouses}}', [
            'code' => 'IDW01',
            'name' => 'Raw Material ID',
            'location_id' => 1,
        ]);
        $this->insert('{{%warehouses}}', [
            'code' => 'IDW02',
            'name' => 'Finished Goods ID',
            'location_id' => 1,
        ]);
        $this->insert('{{%warehouses}}', [
            'code' => 'MYW01',
            'name' => 'Raw Material MY',
            'location_id' => 2,
        ]);
        $this->insert('{{%warehouses}}', [
            'code' => 'MYW02',
            'name' => 'Finished Goods MY',
            'location_id' => 2,
        ]);
        $this->insert('{{%warehouses}}', [
            'code' => 'SAW01',
            'name' => 'Raw Material SA',
            'location_id' => 3,
        ]);
        $this->insert('{{%warehouses}}', [
            'code' => 'SAW02',
            'name' => 'Finished Goods SA',
            'location_id' => 3,
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%warehouses}}');
    }

}
