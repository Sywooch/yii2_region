<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TourInfoHasTourTypeTransport]].
 *
 * @see TourInfoHasTourTypeTransport
 */
class TourInfoHasTourTypeTransportQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TourInfoHasTourTypeTransport[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TourInfoHasTourTypeTransport|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
