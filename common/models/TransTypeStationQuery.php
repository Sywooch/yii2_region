<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TransTypeStation]].
 *
 * @see TransTypeStation
 */
class TransTypeStationQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TransTypeStation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransTypeStation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
