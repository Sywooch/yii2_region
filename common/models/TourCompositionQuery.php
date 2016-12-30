<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TourComposition]].
 *
 * @see TourComposition
 */
class TourCompositionQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TourComposition[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TourComposition|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}