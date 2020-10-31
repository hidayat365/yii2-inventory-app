<?php

use yii\db\Schema;
use yii\db\Migration;

class m151208_235518_create_table_items extends Migration
{
    public function up()
    {
        $this->createTable('{{%items}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(100)->notNull(),
            'type_id' => $this->integer()->notNull(),
            'specification' => $this->text(),
        ]);

        // foreign keys
        $this->addForeignKey(
            'fk_items_types', 
            '{{%items}}', 'type_id', 
            '{{%item_types}}', 'id', 
            'restrict', 'cascade'
        );

        // default data
        $this->insert('{{%items}}', [
            'code' => 'RM01',
            'name' => 'Habbatussauda',
            'type_id' => 1,
            'specification' => 'Habbatussauda Super',
        ]);
        $this->insert('{{%items}}', [
            'code' => 'RM02',
            'name' => 'Minyak Zaitun',
            'type_id' => 1,
            'specification' => 'Minyak Zaitun Bubuk',
        ]);
        $this->insert('{{%items}}', [
            'code' => 'RM03',
            'name' => 'Madu Hutan Asli',
            'type_id' => 1,
            'specification' => 'Madu Super Plus Propolis',
        ]);
        $this->insert('{{%items}}', [
            'code' => 'FG01',
            'name' => 'Habbat+ Zaitun Softgel',
            'type_id' => 2,
            'specification' => 'Habbatussauda Super plus Minyak Zaitun Softgel',
        ]);
        $this->insert('{{%items}}', [
            'code' => 'FG02',
            'name' => 'Madu++ Barokah',
            'type_id' => 2,
            'specification' => 'Madu++ Propolis, Habbatussauda, dan Minyak Zaitun',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%items}}');
    }

}
