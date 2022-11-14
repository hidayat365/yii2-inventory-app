<?php

namespace app\modules\inventory\models;

use Yii;

/**
 * This is the model class for table "inventory_cards".
 *
 * @property int $trans_id
 * @property string $trans_code
 * @property int $trans_date
 * @property int $detail_id
 * @property int $item_id
 * @property string $warehouse_code
 * @property string $warehouse_name
 * @property string $item_code
 * @property string $item_name
 * @property float $quantity
 * @property string|null $remarks
 */
class InventoryCards extends \yii\db\ActiveRecord
{
    public $primaryKey = "detail_id";

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory_cards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_id', 'trans_date', 'detail_id', 'item_id'], 'integer'],
            [['trans_code', 'item_id', 'warehouse_code', 'warehouse_name', 'item_code', 'item_name'], 'required'],
            [['quantity'], 'number'],
            [['remarks'], 'string'],
            [['trans_code', 'warehouse_code', 'item_code'], 'string', 'max' => 50],
            [['warehouse_name', 'item_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'trans_id' => Yii::t('app', 'Trans ID'),
            'trans_code' => Yii::t('app', 'Trans Code'),
            'trans_date' => Yii::t('app', 'Trans Date'),
            'detail_id' => Yii::t('app', 'Detail ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'warehouse_code' => Yii::t('app', 'Warehouse Code'),
            'warehouse_name' => Yii::t('app', 'Warehouse Name'),
            'item_code' => Yii::t('app', 'Item Code'),
            'item_name' => Yii::t('app', 'Item Name'),
            'quantity' => Yii::t('app', 'Quantity'),
            'remarks' => Yii::t('app', 'Remarks'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return InventoryCardsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InventoryCardsQuery(get_called_class());
    }
}
