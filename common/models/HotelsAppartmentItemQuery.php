<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HotelsAppartmentItem]].
 *
 * @see HotelsAppartmentItem
 */
class HotelsAppartmentItemQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return HotelsAppartmentItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return HotelsAppartmentItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}