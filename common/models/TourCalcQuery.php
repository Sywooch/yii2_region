<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TourCalc]].
 *
 * @see TourCalc
 */
class TourCalcQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TourCalc[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TourCalc|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}