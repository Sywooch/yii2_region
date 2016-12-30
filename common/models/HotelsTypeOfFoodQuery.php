<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HotelsTypeOfFood]].
 *
 * @see HotelsTypeOfFood
 */
class HotelsTypeOfFoodQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return HotelsTypeOfFood[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return HotelsTypeOfFood|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}