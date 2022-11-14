<?php

namespace app\modules\shared\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property integer $id
 * @property string $trans_code
 * @property string $trans_date
 * @property integer $type_id
 * @property string $remarks
 *
 * @property TransactionDetails[] $transactionDetails
 * @property TransactionTypes $type
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trans_code', 'type_id'], 'required'],
            [['trans_date'], 'safe'],
            [['type_id'], 'integer'],
            [['trans_code', 'remarks'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trans_code' => 'Transaction Code',
            'trans_date' => 'Transaction Date',
            'type_id' => 'Transaction Type',
            'remarks' => 'Remarks',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionDetails()
    {
        return $this->hasMany(TransactionDetails::className(), ['trans_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TransactionTypes::className(), ['id' => 'type_id']);
    }
}
