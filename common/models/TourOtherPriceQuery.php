<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TourOtherPrice]].
 *
 * @see TourOtherPrice
 */
class TourOtherPriceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TourOtherPrice[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TourOtherPrice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}