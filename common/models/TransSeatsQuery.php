<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TransSeats]].
 *
 * @see TransSeats
 */
class TransSeatsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TransSeats[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransSeats|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}