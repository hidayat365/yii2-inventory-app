<?php

use yii\db\Schema;
use yii\db\Migration;

class m151208_235500_create_table_locations extends Migration
{
    public function up()
    {
        $this->createTable('{{%locations}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(100)->notNull(),
            'address' => $this->text(),
        ]);

        // default data
        $this->insert('{{%locations}}', [
            'id' => 1,
            'code' => 'ID',
            'name' => 'Indonesia',
        ]);
        $this->insert('{{%locations}}', [
            'id' => 2,
            'code' => 'MY',
            'name' => 'Malaysia',
        ]);
        $this->insert('{{%locations}}', [
            'id' => 3,
            'code' => 'SA',
            'name' => 'Saudi Arabia',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%locations}}');
    }

}
