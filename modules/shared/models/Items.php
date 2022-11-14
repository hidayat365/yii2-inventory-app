<?php

namespace app\modules\shared\models;

use app\modules\inventory\models\ItemInventories;
use app\modules\shared\models\TransactionDetails;
use Yii;

/**
 * This is the model class for table "items".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $type_id
 * @property string|null $specification
 *
 * @property ItemInventories[] $itemInventories
 * @property TransactionDetails[] $transactionDetails
 * @property ItemTypes $type
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'type_id'], 'required'],
            [['type_id'], 'integer'],
            [['specification'], 'string'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['code'], 'unique'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemTypes::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'type_id' => Yii::t('app', 'Type'),
            'specification' => Yii::t('app', 'Specification'),
        ];
    }

    /**
     * Gets query for [[ItemInventories]].
     *
     * @return \yii\db\ActiveQuery|ItemInventoriesQuery
     */
    public function getItemInventories()
    {
        return $this->hasMany(ItemInventories::className(), ['item_id' => 'id']);
    }

    /**
     * Gets query for [[TransactionDetails]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getTransactionDetails()
    {
        return $this->hasMany(TransactionDetails::className(), ['item_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery|ItemTypesQuery
     */
    public function getType()
    {
        return $this->hasOne(ItemTypes::className(), ['id' => 'type_id']);
    }

    /**
     * {@inheritdoc}
     * @return ItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemsQuery(get_called_class());
    }
}
