<?php

namespace app\modules\inventory\models;

use Yii;

/**
 * This is the model class for table "item_transactions".
 *
 * @property integer $trans_id
 * @property string $trans_code
 * @property string $trans_date
 * @property integer $detail_id
 * @property integer $item_id
 * @property string $quantity
 * @property string $remarks
 * @property string $item_code
 * @property string $item_name
 */
class ItemTransactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trans_id', 'detail_id', 'item_id'], 'integer'],
            [['trans_code', 'item_code', 'item_name'], 'required'],
            [['trans_date'], 'safe'],
            [['quantity'], 'number'],
            [['trans_code', 'remarks', 'item_code', 'item_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'trans_id' => 'Trans ID',
            'trans_code' => 'Trans Code',
            'trans_date' => 'Trans Date',
            'detail_id' => 'Detail ID',
            'item_id' => 'Item ID',
            'quantity' => 'Quantity',
            'remarks' => 'Remarks',
            'item_code' => 'Item Code',
            'item_name' => 'Item Name',
        ];
    }
}
