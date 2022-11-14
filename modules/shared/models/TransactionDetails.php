<?php

namespace app\modules\shared\models;

use app\modules\master\models\Items;
use Yii;

/**
 * This is the model class for table "transaction_details".
 *
 * @property integer $id
 * @property integer $trans_id
 * @property integer $item_id
 * @property string $quantity
 * @property string $remarks
 *
 * @property Items $item
 * @property Transactions $trans
 */
class TransactionDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trans_id'], 'required'],
            [['trans_id', 'item_id'], 'integer'],
            [['quantity'], 'number'],
            [['remarks'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trans_id' => 'Trans ID',
            'item_id' => 'Item',
            'quantity' => 'Quantity',
            'remarks' => 'Remarks',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrans()
    {
        return $this->hasOne(Transactions::className(), ['id' => 'trans_id']);
    }
}
