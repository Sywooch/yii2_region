<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BusWay]].
 *
 * @see BusWay
 */
class BusWayQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return BusWay[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BusWay|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}