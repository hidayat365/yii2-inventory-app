<?php

namespace app\modules\inventory\models;

/**
 * This is the ActiveQuery class for [[ItemInventories]].
 *
 * @see ItemInventories
 */
class ItemInventoriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ItemInventories[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ItemInventories|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
