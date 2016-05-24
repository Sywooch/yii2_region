<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[\common\models\TransReservation]].
 *
 * @see \common\models\TransReservation
 */
class TransReservationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\TransReservation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TransReservation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
