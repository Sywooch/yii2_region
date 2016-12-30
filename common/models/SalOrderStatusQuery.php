<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SalOrderStatus]].
 *
 * @see SalOrderStatus
 */
class SalOrderStatusQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[active]]=1');
    }

    /**
     * @inheritdoc
     * @return SalOrderStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SalOrderStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
