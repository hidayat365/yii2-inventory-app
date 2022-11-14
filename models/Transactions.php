<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property int $id
 * @property string $trans_code
 * @property int $trans_date
 * @property int $type_id
 * @property int $warehouse_id
 * @property string|null $remarks
 *
 * @property TransactionDetails[] $transactionDetails
 * @property TransactionTypes $type
 * @property Warehouses $warehouse
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_code', 'type_id', 'warehouse_id'], 'required'],
            [['trans_date', 'type_id', 'warehouse_id'], 'integer'],
            [['remarks'], 'string'],
            [['trans_code'], 'string', 'max' => 50],
            [['trans_code'], 'unique'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionTypes::class, 'targetAttribute' => ['type_id' => 'id']],
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
            'trans_code' => Yii::t('app', 'Transaction Code'),
            'trans_date' => Yii::t('app', 'Transaction Date'),
            'type_id' => Yii::t('app', 'Type'),
            'warehouse_id' => Yii::t('app', 'Warehouse'),
            'remarks' => Yii::t('app', 'Remarks'),
        ];
    }

    /**
     * Gets query for [[TransactionDetails]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getTransactionDetails()
    {
        return $this->hasMany(TransactionDetails::class, ['trans_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TransactionTypes::class, ['id' => 'type_id']);
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
     * @return TransactionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransactionsQuery(get_called_class());
    }
}
