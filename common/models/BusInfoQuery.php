<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BusInfo]].
 *
 * @see BusInfo
 */
class BusInfoQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return BusInfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BusInfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}