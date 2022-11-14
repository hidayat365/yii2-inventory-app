<?php

namespace app\modules\master\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $address
 *
 * @property Warehouses[] $warehouses
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['address'], 'string'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['code'], 'unique'],
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
            'address' => Yii::t('app', 'Address'),
        ];
    }

    /**
     * Gets query for [[Warehouses]].
     *
     * @return \yii\db\ActiveQuery|WarehousesQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouses::className(), ['location_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return LocationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocationsQuery(get_called_class());
    }
}
