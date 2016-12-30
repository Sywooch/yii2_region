<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[\common\models\TransPriceType]].
 *
 * @see \common\models\TransPriceType
 */
class TransPriceTypeQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return \common\models\TransPriceType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TransPriceType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
