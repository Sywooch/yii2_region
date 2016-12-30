<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HotelsPricing]].
 *
 * @see HotelsPricing
 */
class HotelsPricingQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return HotelsPricing[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return HotelsPricing|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
