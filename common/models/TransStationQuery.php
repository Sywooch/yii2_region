<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TransStation]].
 *
 * @see TransStation
 */
class TransStationQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TransStation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransStation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}