<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TourPrice]].
 *
 * @see TourPrice
 */
class TourPriceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TourPrice[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TourPrice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}