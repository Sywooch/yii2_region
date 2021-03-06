<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HotelsCharacterItem]].
 *
 * @see HotelsCharacterItem
 */
class HotelsCharacterItemQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return HotelsCharacterItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return HotelsCharacterItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
