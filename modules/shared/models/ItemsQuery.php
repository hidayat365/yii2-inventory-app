<?php

namespace app\modules\shared\models;

/**
 * This is the ActiveQuery class for [[Items]].
 *
 * @see Items
 */
class ItemsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Items[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Items|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
