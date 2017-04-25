<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[KursCurrency]].
 *
 * @see KursCurrency
 */
class KursCurrencyQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return KursCurrency[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return KursCurrency|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}