<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ItemTypes]].
 *
 * @see ItemTypes
 */
class ItemTypesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ItemTypes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ItemTypes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
