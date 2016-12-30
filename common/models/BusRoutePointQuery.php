<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BusRoutePoint]].
 *
 * @see BusRoutePoint
 */
class BusRoutePointQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return BusRoutePoint[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BusRoutePoint|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}