<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[\common\models\BusWayGenerator]].
 *
 * @see \common\models\BusWayGenerator
 */
class BusWayGeneratorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\BusWayGenerator[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\BusWayGenerator|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}