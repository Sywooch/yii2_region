<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HotelsOthersPricing]].
 *
 * @see HotelsOthersPricing
 */
class HotelsOthersPricingQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return HotelsOthersPricing[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return HotelsOthersPricing|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}