<?php

namespace app\modules\shared\models;

use Yii;

/**
 * This is the model class for table "transaction_types".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 *
 * @property Transactions[] $transactions
 */
class TransactionTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Type ID',
            'code' => 'Type Code',
            'name' => 'Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::className(), ['type_id' => 'id']);
    }
}
