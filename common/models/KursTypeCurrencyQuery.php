<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[KursTypeCurrency]].
 *
 * @see KursTypeCurrency
 */
class KursTypeCurrencyQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return KursTypeCurrency[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return KursTypeCurrency|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}