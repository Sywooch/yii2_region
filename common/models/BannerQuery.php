<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Banner]].
 *
 * @see Banner
 */
class BannerQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return Banner[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Banner|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
