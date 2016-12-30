<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TransSeatsType]].
 *
 * @see TransSeatsType
 */
class TransSeatsTypeQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TransSeatsType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransSeatsType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}