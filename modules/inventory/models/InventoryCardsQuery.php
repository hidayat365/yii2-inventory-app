<?php

namespace app\modules\inventory\models;

/**
 * This is the ActiveQuery class for [[InventoryCards]].
 *
 * @see InventoryCards
 */
class InventoryCardsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InventoryCards[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InventoryCards|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
