<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TourTypeTransport]].
 *
 * @see TourTypeTransport
 */
class TourTypeTransportQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TourTypeTransport[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TourTypeTransport|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}