<?php

use yii\db\Schema;
use yii\db\Migration;

class m151208_235510_create_table_item_types extends Migration
{
    public function up()
    {
        $this->createTable('{{%item_types}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(100)->notNull(),
        ]);

        // default data
        $this->insert('{{%item_types}}', [
            'id' => 1,
            'code' => 'RM',
            'name' => 'Raw Material',
        ]);
        $this->insert('{{%item_types}}', [
            'id' => 2,
            'code' => 'FG',
            'name' => 'Finished Goods',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%item_types}}');
    }

}
