<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HotelsPayPeriod]].
 *
 * @see HotelsPayPeriod
 */
class HotelsPayPeriodQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return HotelsPayPeriod[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return HotelsPayPeriod|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
