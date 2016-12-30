<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TourType]].
 *
 * @see TourType
 */
class TourTypeQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TourType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TourType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}