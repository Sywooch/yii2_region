<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TransReservation]].
 *
 * @see TransReservation
 */
class TransReservationQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TransReservation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransReservation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}