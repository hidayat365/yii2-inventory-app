<?php

namespace app\modules\master\models;

use app\modules\inventory\models\ItemInventories;
use app\modules\shared\models\Transactions;
use Yii;

/**
 * This is the model class for table "warehouses".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $location_id
 *
 * @property ItemInventories[] $itemInventories
 * @property Locations $location
 * @property Transactions[] $transactions
 */
class Warehouses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'location_id'], 'required'],
            [['location_id'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['code'], 'unique'],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['location_id' => 'id']],
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
            'location_id' => Yii::t('app', 'Location'),
        ];
    }

    /**
     * Gets query for [[ItemInventories]].
     *
     * @return \yii\db\ActiveQuery|ItemInventoriesQuery
     */
    public function getItemInventories()
    {
        return $this->hasMany(ItemInventories::className(), ['warehouse_id' => 'id']);
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery|LocationsQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Locations::className(), ['id' => 'location_id']);
    }

    /**
     * Gets query for [[Transactions]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::className(), ['warehouse_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return WarehousesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WarehousesQuery(get_called_class());
    }
}
