<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SalOrder]].
 *
 * @see SalOrder
 */
class SalOrderQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return SalOrder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SalOrder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}