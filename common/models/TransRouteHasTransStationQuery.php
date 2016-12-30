<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TransRouteHasTransStation]].
 *
 * @see TransRouteHasTransStation
 */
class TransRouteHasTransStationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TransRouteHasTransStation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransRouteHasTransStation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}