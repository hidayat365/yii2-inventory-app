<?php

namespace app\modules\inventory\models;

use Yii;

/**
 * This is the model class for table "item_inventories".
 *
 * @property int $id
 * @property int $item_id
 * @property int $warehouse_id
 * @property float $quantity
 *
 * @property Items $item
 * @property Warehouses $warehouse
 */
class ItemInventories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_inventories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'warehouse_id'], 'required'],
            [['item_id', 'warehouse_id'], 'integer'],
            [['quantity'], 'number'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::class, 'targetAttribute' => ['item_id' => 'id']],
            [['warehouse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouses::class, 'targetAttribute' => ['warehouse_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'warehouse_id' => Yii::t('app', 'Warehouse ID'),
            'quantity' => Yii::t('app', 'Quantity'),
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery|ItemsQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::class, ['id' => 'item_id']);
    }

    /**
     * Gets query for [[Warehouse]].
     *
     * @return \yii\db\ActiveQuery|WarehousesQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(Warehouses::class, ['id' => 'warehouse_id']);
    }

    /**
     * {@inheritdoc}
     * @return ItemInventoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemInventoriesQuery(get_called_class());
    }
}
