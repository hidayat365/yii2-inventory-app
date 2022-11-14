<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Transactions]].
 *
 * @see Transactions
 */
class TransactionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Transactions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Transactions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
