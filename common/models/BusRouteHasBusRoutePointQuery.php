<?php

namespace common\models;


/**
 * This is the ActiveQuery class for [[BusRouteHasBusRoutePoint]].
 *
 * @see BusRouteHasBusRoutePoint
 */
class BusRouteHasBusRoutePointQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    public function allOrder()
    {

    }

    /**
     * @inheritdoc
     * @return BusRouteHasBusRoutePoint[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BusRouteHasBusRoutePoint|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
