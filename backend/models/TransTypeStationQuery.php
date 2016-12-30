<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[\backend\models\TransTypeStation]].
 *
 * @see \backend\models\TransTypeStation
 */
class TransTypeStationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\TransTypeStation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\TransTypeStation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}