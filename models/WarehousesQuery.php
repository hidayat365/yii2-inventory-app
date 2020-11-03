<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Warehouses]].
 *
 * @see Warehouses
 */
class WarehousesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Warehouses[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Warehouses|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
