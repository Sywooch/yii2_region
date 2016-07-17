<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TourInfoHasTourType]].
 *
 * @see TourInfoHasTourType
 */
class TourInfoHasTourTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TourInfoHasTourType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TourInfoHasTourType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
