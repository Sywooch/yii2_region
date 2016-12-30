<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BusRoute]].
 *
 * @see BusRoute
 */
class BusRouteQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return BusRoute[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BusRoute|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
