<?php

namespace app\modules\master\models;

/**
 * This is the ActiveQuery class for [[Locations]].
 *
 * @see Locations
 */
class LocationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Locations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Locations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
