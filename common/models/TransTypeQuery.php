<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TransType]].
 *
 * @see TransType
 */
class TransTypeQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TransType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
