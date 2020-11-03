<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_types".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @property Items[] $items
 */
class ItemTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
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
        ];
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ItemTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemTypesQuery(get_called_class());
    }
}
