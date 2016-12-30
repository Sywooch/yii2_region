<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BusReservation]].
 *
 * @see BusReservation
 */
class BusReservationQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return BusReservation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BusReservation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}